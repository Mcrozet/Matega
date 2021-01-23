<?php 

namespace Models;

class City extends DatabaseObject{
    
    public function isCity($cityName)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM cities WHERE name LIKE ? ORDER BY name LIMIT 10'); 
        $req->execute(array('%' . $cityName . '%'));
        return $req;
    }

    public function getCity($city)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM cities WHERE name = ?'); 
        $req->execute(array($city));
        return $req;
    }

    public function getAdressByIdUser($idUser)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM adress WHERE id_user = ?'); 
        $req->execute(array($idUser));        
        $result = $req->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function addNewAdress($idUser, $name, $location, $cp, $city)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('INSERT INTO adress (id_user, name, location, cp, city) 
                            VALUES (:id_user, :name, :location, :cp, :city)');
        $req->execute(array(
            'id_user' => $idUser,
            'name' => $name,
            'location' => $location,
            'cp' => $cp,
            'city' => $city
        ));
    }

    function getAdressByIdUserAndId($idUser, $id)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM adress WHERE id_user = ? AND id = ?'); 
        $req->execute(array($idUser, $id));        
        $result = $req->fetch();
        return $result;
    }
}