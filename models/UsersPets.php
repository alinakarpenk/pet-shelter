<?php

namespace models;

use core\DataBase;

class UsersPets
{
    protected $db;
    protected $table = 'users_pets';

    public function __construct()
    {
        $this->db = new DataBase();
    }
    public function addFavouritePet($userId, $petId, $image, $name, $description, $categoryId)
    {
        $row = ['users_id' => $userId, 'pets_id' => $petId, 'image'=>$image, 'name'=>$name, 'description'=>$description, 'category_id' => $categoryId];
        return $this->db->insert($this->table, $row);
    }
    public function deleteFavouritePet($userId, $petId)
    {
        $where = ['users_id' => $userId, 'pets_id'=>$petId];
        return $this->db->delete($this->table, $where);
    }
    public function getPetById($id)
    {
        $where = ['pets_id' => $id];
        $pets = $this->db->select('users_pets', '*', $where);
        if (!empty($pets)) {
            return $pets;
        } else {
            return [];
        }
    }
    public function isFavourite($userId, $petId)
    {
        $where = ['users_id' => $userId, 'pets_id' => $petId];
        $res = $this->db->select($this->table,'*', $where);
        return !empty($res);

    }
    public function getAll($userId)
    {
        $where = ['users_id' => $userId];
        return $this->db->select($this->table, '*', $where);
    }
    public function getAdoptedPetsWithUsers()
    {
        $sql = 'SELECT users_pets.id, users.email as user_email, users_pets.name as pet_name
            FROM users_pets
            JOIN users ON users_pets.users_id = users.id';
        $res = $this->db->query($sql);
        return $res;
    }

}