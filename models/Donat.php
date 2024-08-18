<?php
namespace models;

use core\DataBase;
use core\Core;
class Donat
{
    protected $db;
    protected $table = 'donations';

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function getAllDonate()
    {
        return $this->db->select($this->table);
    }
    public function addDonate($name,$email,$card_number, $cvv, $date, $amount)
    {
        $row = ['name' => $name, 'email' => $email, 'card_number'=>$card_number, 'CVV' => $cvv, 'date' => $date, 'amount' => $amount ];
        return $this->db->insert($this->table, $row);
    }

}
