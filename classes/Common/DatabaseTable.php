<?php

namespace Common;


class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    public function __construct(\PDO $pdo, $table, $primaryKey)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }
    private function query($sql, $parameters = null){
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    public function customSql($sql){
        $this->query($sql);
    }

    public function insertIntoDb($data){
        $sql = 'INSERT INTO '   . $this->table . ' SET ';
        foreach ($data as $key => $value){
            $sql .=   $key  .  ' = ' .  "'" .$value . "'" . ', ';
        }
        $sql = rtrim($sql, ', ');
        $this->query($sql);
    }

    public function insertMultipleValues($columns, $data){
        $sql = 'INSERT INTO '   . $this->table . ' (';
        foreach ($columns as $column){
            $sql .= $column . ', ';
        }
        $sql = rtrim($sql, ', ');
        $sql .= ' ) VALUES ';
        foreach ($data as $part){
            $sql .= ' (';
            foreach ($part as $element){
                $sql .= "'" . $element . "'" . ', ';
            }
            $sql = rtrim($sql, ', ');
            $sql .= ' ), ';
        }
        $sql = rtrim($sql, ', ');
        $this->query($sql);
    }

    public function findById($value = null){
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :value';
        $parameters = [
            'value' => $value
        ];
        $query = $this->query($sql, $parameters);
        return $query->fetchAll();
    }

    public function selectDataFromDbCustom($selectType, $condition, $key = null){
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ';
        if ($selectType === 'inArray'){
            if (empty($condition)){
                return [];
            }
            $sql .= $key .' IN (';
            foreach ($condition as $part){
                $sql .= "'" . $part . "'" . ', ';
            }
            $sql = rtrim($sql, ', ');
            $sql .= ' )';
        }
        if ($selectType === 'custom'){
            $sql .= $condition;
        }
        $query = $this->query($sql);
        return $query->fetchAll();
    }


    public function selectDataFromDb($condition = null, $columns = null, $orderBy = null, $ascOrDesc = null){
        if ($columns === null){
            $sql = 'SELECT * FROM ' . $this->table;
        }
        else{
            $sql = 'SELECT ';
            foreach ($columns as $column){
                $sql .= $column . ', ';
            }
            $sql = rtrim($sql, ', ');
            $sql .= ' FROM ' . $this->table;
        }

        if ($condition !== null) {
            $sql .= ' WHERE ';
            foreach ($condition as $key => $value) {
                if (gettype($value) === 'array'){
                        $sql .= $key . " BETWEEN " . "'" . $value[0] . "' AND " . "'" . $value[1] . "' AND ";
                }
                else{
                    if ($value !== 'NULL'){
                        $sql .= $key . "=" . "'" . $value . "' AND ";
                    }
                    else {
                        $sql .= $key . " IS " . $value . " AND ";
                    }
                }
                $sql = rtrim($sql, 'AND ');
            }
        }
        if ($orderBy !== null){
            $sql .= ' ORDER BY ' . $orderBy . ' ' . $ascOrDesc;
        }
        $sql =  $sql . ';';

        $query = $this->query($sql);
        return $query->fetchAll();
}

    public function updateValuesInDb($data){
        $sql = 'UPDATE ' . $this->table . ' SET ';
        foreach ($data['set'] as $key => $value){
            if ($value === 'null'){
                $sql .= $key .' = ' .  $value  . ', ';
            }
            else {
                $sql .= $key .' = ' .  "'" . $value . "'" . ', ';
            }
        }
        $sql = rtrim($sql, ', ');
        if (isset($data['conditions'])){
            $sql .= ' WHERE ';
            foreach ($data['conditions'] as $key => $value){
                $sql .= $key . " = '" . $value . "' " . 'AND ';
            }
            $sql = rtrim($sql, ' AND');
        }
        $this->query($sql);
    }


    public function deleteFromDb($value){
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :value';
        $parameters = [
            'value' => $value
        ];
        $this->query($sql, $parameters);
    }
    public function deleteFromDbMultiple($ids){
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' IN ( ';
        foreach ($ids as $id){
            $sql .= "'" . $id . "', ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= ' )';
        $this->query($sql);
    }



}