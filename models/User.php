<?php

namespace models;
use core\Core;
use core\DataBase;

/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $surname
 * @property string $password

 */

class User
{
    protected $db;
    protected $table = 'users';

    public function __construct()
    {
        $this->db = new DataBase();
    }
    public function getAllUsers()
    {
        return $this->db->select($this->table);
    }
    public function getUserById($id)
    {
        $where = ['id' => $id];
        return $this->db->select($this->table, '*', $where);
    }
    public function addUser($name, $surname, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $row = ['name' => $name, 'surname' => $surname, 'email' => $email, 'password' => $passwordHash];
        return $this->db->insert($this->table, $row);
    }
    public function updateUser($id, $username, $password, $email)
    {
        $row = ['username' => $username, 'password' => $password, 'email' => $email];
        $where = ['id' => $id];
        return $this->db->update($this->table, $row, $where);
    }
    public function deleteUser($id)
    {
        $where = ['id' => $id];
        return $this->db->delete($this->table, $where);
    }
    public function findByCondition($conAssArr)
    {
        $arr = $this->db->select($this->table, '*', $conAssArr);
        if (count($arr) > 0) {
            return $arr;
        } else {
            return null;
        }
    }
    public function verifyUser($email, $password)
    {
        $conditions = ['email' => $email];
        $user = $this->findByCondition($conditions);
        if ($user) {
            if (password_verify($password, $user[0]['password'])) {
                return $user[0];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function isLogged()
    {
        return !empty(Core::getInstance()->session->get('user'));
    }

    public function isLogout()
    {
        Core::getInstance()->session->remove('user');
    }

    public function isAdmin()
    {
        $user = Core::getInstance()->session->get('user');
        return isset($user['role']) && $user['role'] === 'admin';
    }

}