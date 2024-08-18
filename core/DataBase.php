<?php

namespace core;

class DataBase
{
    public $pdo;

    public function __construct()
    {
        $host = Config::get()->Host;
        $name = Config::get()->Name;
        $login = Config::get()->Login;
        $password = Config::get()->Password;
        $this->pdo=new \PDO("mysql:host={$host};dbname={$name}", $login,$password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]
        );

    }
    public function where($conditions)
    {
        if (empty($conditions)) {
            return '';
        }
        $where_arr = [];
        foreach ($conditions as $key => $value) {
            $where_arr[] = "{$key} = :{$key}";
        }
        return implode(' AND ', $where_arr);
    }

    public function select($table, $fields = '*', $where = [])
    {
        $sql = "SELECT $fields FROM $table";

        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $column => $value) {
                if (is_array($value)) {
                    throw new \Exception("Parameter value cannot be an array: $column");
                }
                $conditions[] = "$column = :$column";
            }
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $this->pdo->prepare($sql);

        // Перевірка і прив'язка параметрів
        foreach ($where as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($table, $row)
    {
        $fields_list = implode(",", array_keys($row));
        $value_arr = [];
        foreach ($row as $key => $value) {
            $value_arr[] = ":{$key}";
        }
        $value_list = implode(",", $value_arr);
        $sql = "INSERT INTO {$table} ({$fields_list}) VALUES ({$value_list})";
        $stmt = $this->pdo->prepare($sql);
        foreach ($row as $key => $value)
            $stmt->bindValue(":{$key}", $value);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function delete($table, $where)
    {
        $whereClause = [];
        $params = [];
        foreach ($where as $column => $value) {
            $whereClause[] = "`$column` = ?";
            $params[] = $value;
        }
        $whereClause = implode(' AND ', $whereClause);

        $sql = "DELETE FROM `$table` WHERE $whereClause";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $where)
    {
        $setParts = [];
        foreach ($data as $column => $value) {
            $setParts[] = "$column = :$column";
        }
        $setString = implode(', ', $setParts);
        $whereParts = [];
        foreach ($where as $column => $value) {
            $whereParts[] = "$column = :where_$column";
        }
        $whereString = implode(' AND ', $whereParts);
        $sql = "UPDATE $table SET $setString WHERE $whereString";
        $stmt = $this->pdo->prepare($sql);
        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }
        foreach ($where as $column => $value) {
            $stmt->bindValue(":where_$column", $value);
        }
        return $stmt->execute();
    }
}