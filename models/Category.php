<?php

namespace models;

use core\DataBase;

class Category
{
    protected $db;
    protected $table = 'category';
    public function __construct()
    {
        $this->db = new DataBase();
    }
    public function addCategory($title, $image)
    {
        $row = ['title' => $title, 'image' => $image];
        return $this->db->insert($this->table, $row);
    }
    public function getAllCategory()
    {
        return $this->db->select($this->table);
    }
    public function getCategoryById($id)
    {
        $where = ['id' => $id];
        $categories = $this->db->select($this->table, '*', $where);
        if (!empty($categories)) {
            return $categories[0];
        } else {
            return null;
        }
    }

    public function updateCategory($id, $data)
    {
        $where = ['id' => $id];
        return $this->db->update($this->table, $data, $where);
    }
    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);
        if (!$category) {
            return false;
        }
        $where = ['id' => $id];
        return $this->db->delete($this->table, $where);
    }
}

