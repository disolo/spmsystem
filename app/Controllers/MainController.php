<?php
/**
 * Class MainController call methods the model and transfer data to the view
 * 
 * Declare namespace and import classes
 */
namespace App\Controllers;

use App\Models\Database;
use League\Plates\Engine;
use App\Models\Validation;
use App\Models\Pagination;

class MainController
{
    /**
     * @var object $model To work with Database
     * @var object $view To work with Views
     * @var object $validation To work with Validation
     * @var object $pagination To work with Pagination
     */
    private $model;
    private $view;
    private $validation;
    private $pagination;

    public function __construct(Database $model, Engine $view, Validation $validation, Pagination $pagination)
    {
        $this->model = $model;
        $this->view = $view;
        $this->validation = $validation;
        $this->pagination = $pagination;
    }

    /**
     * Show products on page
     * 
     * @param integer $page Number of page
     */
    public function store($page)
    {
        $products = $this->pagination->showPage('products', $page);
        $countPages = $this->pagination->navigate('products');

        echo $this->view->render('store', compact('products', 'page', 'countPages'));
    }
    
    /**
     * Create form new product
     */
    public function create()
    {
        $attributes = $this->model->getAttributes('attributes');
        $values = $this->model->getValues('vals');

        echo $this->view->render('create', compact('attributes', 'values'));
    }

    /**
     * Handler create form new product
     */
    public function add()
    {
            $this->validation->validate('create');
            $this->model->addProduct('products', $_POST);
            $id = $this->model->getIdLastProduct('products');
            $this->model->addProductWithAttribute('prods_attrs', ['prod_id' => $id, 'attr_id' => $_POST['attribute'], 'value_id' => $_POST['value']]);
            $this->store(1);
    }

    /**
     * Product view page
     * 
     * @param integer $id - id selected product
     */
    public function show($id)
    {
        $product = $this->model->showOne('products', $id);
        $resultAttr = $this->model->getAttributeForProduct('prods_attrs', $id);
        $attribute = $this->model->getAttribute('attributes', $resultAttr);
        $resultVal = $this->model->getValueForProduct('prods_attrs', $id);
        $value = $this->model->getValue('vals', $resultVal);

        echo $this->view->render('show', compact('product', 'attribute', 'value'));
    }

    /**
     * Edit form product
     * 
     * @param integer $id - id selected product
     */
    public function edit($id)
    {
        $product = $this->model->edit('products', $id);
        $attributes = $this->model->getAttributes('attributes');
        $values = $this->model->getValues('vals');

        echo $this->view->render('edit', compact('product', 'attributes', 'values'));
    }
    
    /**
     * Handler edit form product
     * 
     * @param integer $id - id selected product
     */
    public function update($id)
    {
        $this->validation->validate("edit/$id");
        $this->model->updateProduct('products', $id, $_POST);
        $this->model->updateProductWithAttribute('prods_attrs', $id, ['attr_id' => $_POST['attribute'], 'value_id' => $_POST['value']]);

        header("Location: /store/1");
    }
    
    /**
     * Handler delete product
     * 
     * @param integer $id - id selected product
     */
    public function delete($id)
    {
        $this->model->deleteProduct('products', $id);
        $this->model->deleteProductWithAttribute('prods_attrs', $id);

        header("Location: /store/1");
    }
}
