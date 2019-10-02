<?php
/**
 * Class Pagination is used to count the number of entries on one page and navigate
 * 
 * Declare namespace and import class
 */
namespace App\Models;

use PDO;


class Pagination
{
    /**
     * @var object $pdo To access Database
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Selected entries with table
     * 
     * Where quantity - number of entries per page
     * 
     * And start - number of start entry per page
     * 
     * @param string  $table Name table in Database
     * 
     * @param integer $page  Number of page
     * 
     * @return array Obtained entries
     */
    public function showPage($table, $page)
    {
        $quantity = 2;
        $start = ($page * $quantity) - $quantity;
        $sql = "SELECT * FROM $table LIMIT $start, $quantity";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Counts the quantity of pages
     * 
     * @param string $table Name table in Database
     * 
     * @return float Obtained сounts the number of pages rounded up
     */
    public function navigate($table)
    {
        $quantity = 2;
        $sql = "SELECT COUNT(*) FROM $table";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $total = $statement->fetch(PDO::FETCH_COLUMN);
        return ceil($total / $quantity);
    }
}
