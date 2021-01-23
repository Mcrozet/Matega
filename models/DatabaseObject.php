<?php

namespace Models;
 
class DatabaseObject{
 
    /**
     * Return only one data
     *
     * @param [string] $data
     * @param [string] $table
     * @param [string] $where
     * @param [string] $value
     * @return array
     */
    function getOne($data, $table, $where, $value)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT ' . $data . ' FROM '.$table.' WHERE '. $where .' = ?');
        $req->execute(array($value));
        $return = $req->fetch(\PDO::FETCH_OBJ);
        return $return;
    }

    /**
     * Return all datas
     *
     * @param [string] $data
     * @param [string] $table
     * @param [string] $where
     * @param [string] $value
     * @return array
     */
    function getAll($data, $table, $where, $value)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT ' . $data . ' FROM '.$table.' WHERE '. $where .' = ?');
        $req->execute(array($value));
        $return = $req->fetchAll(\PDO::FETCH_OBJ);
        return $return;
    }
}