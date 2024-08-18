<?php

namespace models;


use core\DataBase;

class Pet
{
    protected $db;
    protected $table = 'pets';

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function addPet($image, $name, $description, $category_id)
    {
        $row = ['image' => $image, 'name' => $name, 'description'=>$description, 'category_id'=>$category_id];
        return $this->db->insert($this->table, $row);
    }

    public function getAllPets()
    {
        return $this->db->select($this->table);
    }
    public function updatePet($id, $data)
    {
        $where = ['id' => $id];
        return $this->db->update($this->table, $data, $where);
    }
    public function deletePet($id)
    {
        $pet = $this->getPetById($id);
        if (!$pet) {
            return false;
        }
        $where = ['id' => $id];
        return $this->db->delete($this->table, $where);
    }

    public function getPetById($id)
    {
        $where = ['id' => $id];
        $pets = $this->db->select('pets', '*', $where);
        if (!empty($pets)) {
            return $pets[0];
        } else {
            return null;
        }
    }

    public function getPetsByCategory($categoryId)
    {
        $where = ['category_id' => $categoryId];
        return $this->db->select($this->table, '*', $where);
    }
}