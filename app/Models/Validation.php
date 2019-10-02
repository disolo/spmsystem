<?php
/**
 * Class Validation is used to validate input data
 */
namespace App\Models;

class Validation
{
    /** 
     * @param integer $page Number of page
     */
    public function validate($page)
    {
        if (iconv_strlen($_POST['title']) < 5) {
            $_SESSION['title'] = '(Введите название товара, не менее 5 символов)';
            header("Location: /$page");
        }
        else if (iconv_strlen($_POST['description']) < 10) {
            $_SESSION['description'] = '(Введите описание товара, не менее 10 символов)';
            header("Location: /$page");
        }
        else if (!filter_var($_POST['price'], FILTER_VALIDATE_FLOAT)) {
            $_SESSION['price'] = '(Введите корректную цену продукта)';
            header("Location: /$page");
        }

        $_POST['title'] = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
        $_POST['description'] = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
    }
}
