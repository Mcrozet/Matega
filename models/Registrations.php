<?php 

namespace Models;

class Registrations extends DatabaseObject{

    /**
     * Add bank datas user in db
     *
     * @param [int] $idUser
     * @param [string] $name
     * @param [string] $iban
     * @param [string] $bic
     * @param [string] $bankName
     * @return void
     */
    function addBankDatas($idUser, $name, $iban, $bic, $bankName)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('INSERT INTO bankdatas (idUser, name, iban, bic, bankName) VALUES(:idUser, :name, :iban, :bic, :bankName)');
        $req->bindValue(':idUser', $idUser);
        $req->bindValue(':name', $name);
        $req->bindValue(':iban', $iban);
        $req->bindValue(':bic', $bic);
        $req->bindValue(':bankName', $bankName);
        $req->execute();
    }

    /**
     * Add bank datas user in db
     *
     * @param [int] $idUser
     * @param [string] $name
     * @param [string] $iban
     * @param [string] $bic
     * @param [string] $bankName
     * @return void
     */
    function updateBankDatas($idUser, $name, $iban, $bic, $bankName)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('UPDATE bankdatas SET idUser = ?, name = ?, iban = ?, bic = ?, bankName = ? WHERE idUser = ?');
        $req->execute(array(
            $idUser,
            $name,
            $iban,
            $bic,
            $bankName,
            $idUser
        ));
    }
}