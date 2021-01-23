<?php 

namespace Models;

class User extends DatabaseObject{
    
    public function addNewUser($username, $pass)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect(); 
        $req = $db->prepare('INSERT INTO users (name, password) VALUES(:name, :password)');
        $req->bindValue(':name', htmlspecialchars($username));
        $req->bindValue(':password', htmlspecialchars($pass));
        $req->execute();
    }  

    public function createProfil($id, $post, $favorites)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect(); 
        $req = $db->prepare('INSERT INTO profil (id_user, mail, dci, commander, legacy, standard, modern, vintage, newTournament) VALUES(:id_user, :mail, :dci, :commander, :legacy, :standard, :modern, :vintage, :newTournament)');
        $req->bindValue(':id_user', $id);
        $req->bindValue(':mail', htmlspecialchars($post['mail']));
        $req->bindValue(':dci', htmlspecialchars($post['dci']));
        $req->bindValue(':commander', $favorites['commander']);
        $req->bindValue(':legacy', $favorites['legacy']);
        $req->bindValue(':standard', $favorites['standard']);
        $req->bindValue(':modern', $favorites['modern']);
        $req->bindValue(':vintage', $favorites['vintage']);
        $req->bindValue(':newTournament', htmlspecialchars($post['newTournament']));
        $req->execute();
    }

    public function updateProfil($id, $post, $favorites)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('UPDATE profil SET mail = ?, dci = ?, commander = ?, legacy = ?, standard = ?, modern = ?, vintage = ?, newTournament = ? WHERE id_user=?');
        $req->execute(array(
            htmlspecialchars($post['mail']),
            htmlspecialchars($post['dci']),
            $favorites['commander'],
            $favorites['legacy'],
            $favorites['standard'],
            $favorites['modern'],
            $favorites['vintage'],
            htmlspecialchars($post['newTournament']),
            $id
        ));
    }
}