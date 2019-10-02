<?php
/**
 * Class Database describes the logic of work with Database
 * 
 * Declare namespace and import classes
 */
namespace App\Models;

use Aura\SqlQuery\QueryFactory;
use PDO;

class Database
{
    /**
     * @var object $queryFactory To build queries
     * @var object $pdo To access Database
     */
    private $queryFactory;
    private $pdo;

    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
    }

    /**
     * @param string $table Name table in Database
     * 
     * @return array Obtained attributes
     */
    public function getAttributes($table)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table Name table in Database
     * 
     * @return array Obtained values
     */
    public function getValues($table)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * @param string $table Name table in Database
     * 
     * @param array $data - data with create form new product
     */
    public function addProduct($table, $data)
    {
        $data = array_diff_key($data, ['attribute' => 'a', 'value' => 'v']);
        $insert = $this->queryFactory->newInsert();
        $insert->into($table)->cols($data);
        $uploaddir = 'uploads/';
        $bytes = bin2hex(random_bytes(5));
        $uploadfile = $uploaddir . $bytes . basename($_FILES['image']['name']);
        if (!empty($_FILES['image']['tmp_name'])) {
            copy($_FILES['image']['tmp_name'], $uploadfile);
            $insert->into($table)->cols(['image' => $uploadfile]);    
        } else { 
            $uploadfile = 'images/no-image.png';
            $insert->into($table)->cols(['image' => $uploadfile]);
        }
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

    /**
     * @param string $table Name table in Database
     * 
     * @return string ID last add product in table
     */
    public function getIdLastProduct($table)
    {
        $id = $this->pdo->lastInsertId();
        return $id;
    }

    /**
     * @param string $table Name table in Database
     * 
     * @param array $data - data with create form new product
     */
    public function addProductWithAttribute($table, $data)
    {
        $insert = $this->queryFactory->newInsert();
        $insert->into($table)->cols($data);    
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

    /**
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     *
     * @return array obtained result 
     */
    public function showOne($table, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     * 
     * @return mixed obtained result 
     */
    public function getAttributeForProduct($table, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['attr_id'])->from($table)->where('prod_id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * @param string $table Name table in Database
     * 
     * @param mixed $ids - id attributes
     * 
     * @return mixed obtained result 
     */
    public function getAttribute($table, $ids)
    {
        $sql = "SELECT title FROM $table WHERE id IN ($ids)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $ids);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     * 
     * @return mixed obtained result 
     */
    public function getValueForProduct($table, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['value_id'])->from($table)->where('prod_id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * @param string $table Name table in Database
     * 
     * @param mixed $id - id values
     * 
     * @return mixed obtained result 
     */
    public function getValue($table, $ids)
    {
        $sql = "SELECT title FROM $table WHERE id IN ($ids)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $ids);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_COLUMN);
    }
    
    /**
     * Autofills in the edit form product fields
     * 
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     * 
     * @return array obtained result 
     */
    public function edit($table, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Handler edit form product for product
     * 
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     * 
     * @param array $data - data with edit form
     */
    public function updateProduct($table, $id, $data)
    {
        if (!empty($_FILES['image']['tmp_name'])) {
            $select = $this->queryFactory->newSelect();
            $select->cols(['image'])->from($table)->where('id = :id')->bindValue('id', $id);
            $sth = $this->pdo->prepare($select->getStatement());
            $sth->execute($select->getBindValues());
            $result = $sth->fetch(PDO::FETCH_COLUMN);
            $uploaddir = 'uploads/';
            $bytes = bin2hex(random_bytes(5));
            $uploadfile = $uploaddir . $bytes . basename($_FILES['image']['name']);
            copy($_FILES['image']['tmp_name'], $uploadfile);
            $data = array_diff_key($data, ['attribute' => 'a', 'value' => 'v']);
            $data['image'] = $uploadfile;
            $update = $this->queryFactory->newUpdate();
            $update->table($table)->cols($data)->where('id = :id')->bindValue('id', $id);
            $sth = $this->pdo->prepare($update->getStatement());
            $sth->execute($update->getBindValues());
            if ($result !== 'images/no-image.png') {
                unlink($result);
            }  
        }
        $data = array_diff_key($data, ['attribute' => 'a', 'value' => 'v']);
        $update = $this->queryFactory->newUpdate();
        $update->table($table)->cols($data)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }

    /**
     * Handler edit form product for attributes
     * 
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     * 
     * @param array $data - data with edit form
     */
    public function updateProductWithAttribute($table, $id, $data)
    {
        $update = $this->queryFactory->newUpdate();
        $update->table($table)->cols($data)->where('prod_id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }
    
    /**
     * Delete product with table
     * 
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     */
    public function deleteProduct($table, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['image'])->from($table)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetch(PDO::FETCH_COLUMN);
        $delete = $this->queryFactory->newDelete();
        $del = $delete->from($table)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
        if ($result !== 'images/no-image.png') {
            unlink($result);
        }
    }

    /**
     * Delete attributes with table
     * 
     * @param string $table Name table in Database
     * 
     * @param integer $id - id selected product
     */
    public function deleteProductWithAttribute($table, $id)
    {
        $delete = $this->queryFactory->newDelete();
        $delete->from($table)->where('prod_id = :id')->bindValue('id', $id); 
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }
}
