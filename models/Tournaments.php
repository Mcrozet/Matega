<?php 

namespace Models;

class Tournaments extends DatabaseObject{

    public function getAllTournaments($date, $limit = null, $filter = null){
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        if($limit == null){
            $req = $db->prepare('SELECT * FROM tournaments WHERE date >= ? ORDER BY date');
        }
        elseif($filter != null){
            $req = $db->prepare('SELECT * FROM tournaments WHERE date >= ? AND (' . $filter . ') ORDER BY date LIMIT ' . $limit); 
        }
        else{
            $req = $db->prepare('SELECT * FROM tournaments WHERE date >= ? ORDER BY date LIMIT ' . $limit); 
        }
        $req->execute(array($date));
        return $req;
    }

    public function getTournamentsByDate($date1, $date2){
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM tournaments WHERE date >= ? AND date <= ? ORDER BY date'); 
        $req->execute(array($date1, $date2));
        return $req;
    }

    public function getTournamentsByName($name){
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM tournaments WHERE name LIKE ?'); 
        $req->execute(array('%' . $name . '%'));
        return $req;
    }

    public function getAllTournamentsByFormat($date, $format){
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('SELECT * FROM tournaments WHERE date >= ? AND format = ? ORDER BY date'); 
        $req->execute(array($date, $format));
        return $req;
    }

    public function addTournament($post, $date){
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('INSERT INTO tournaments (id_user, name, date, format, preregistration, city, address, cp) 
                            VALUES (:id_user, :name, :date, :format, :preregistration, :city, :address, :cp)');
        $req->execute(array(
            'id_user' => $_SESSION['id'],
            'name' => htmlspecialchars($post['title']),
            'date' => $date,
            'format' => $post['optionFormat'],
            'preregistration' => $post['priceBefore'],
            'city' => htmlspecialchars($post['city']),
            'address' => htmlspecialchars($post['address']),
            'cp' => htmlspecialchars($post['cp'])
        ));
        $lastId = $db->query('SELECT LAST_INSERT_ID()');
        return $lastId->fetch();
    }

    public function addDetails($post, $id_tournament)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('INSERT INTO tournament_details (id_tournament, content, max_registration, email, tournament_start, tournament_insc, priceIn, Buvette, Vendeur, Biere, Alterateur, Tombola) 
                            VALUES (:id_tournament, :content, :max_registration, :email, :tournament_start, :tournament_insc, :priceIn, :Buvette, :Vendeur, :Biere, :Alterateur, :Tombola)');
        $req->execute(array(
            'id_tournament' => $id_tournament,
            'content' => $post['inputContent'],
            'max_registration' => htmlspecialchars($post['maxRegis']),
            'email' => htmlspecialchars($post['email']),
            'tournament_start' => htmlspecialchars($post['tournamentStart']),
            'tournament_insc' => htmlspecialchars($post['tournamentInsc']),
            'priceIn' => htmlspecialchars($post['priceIn']),
            'Buvette' => htmlspecialchars($post['buvette']),
            'Vendeur' => htmlspecialchars($post['vendeur']),
            'Biere' => htmlspecialchars($post['biere']),
            'Alterateur' => htmlspecialchars($post['alterateur']),
            'Tombola' => htmlspecialchars($post['tombola']),
        ));
    }

    public function addRewards($post, $id_tournament)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('INSERT INTO rewards (id_tournament, twentyFirst, twentySecond, twentyTopFour, twentyTopHeight, thirtyFirst, thirtySecond, thirtyTopFour, thirtyTopHeight, thirtyTopSixteen, fiftyFirst, fiftySecond, fiftyTopFour, fiftyTopHeight, fiftyTopSixteen, fiftyTopThirty, fiftyMoreFirst, fiftyMoreSecond, fiftyMoreTopFour, fiftyMoreTopHeight, fiftyMoreTopSixteen, fiftyMoreTopThirty) 
                            VALUES (:id_tournament, :twentyFirst, :twentySecond, :twentyTopFour, :twentyTopHeight, :thirtyFirst, :thirtySecond, :thirtyTopFour, :thirtyTopHeight, :thirtyTopSixteen, :fiftyFirst, :fiftySecond, :fiftyTopFour, :fiftyTopHeight, :fiftyTopSixteen, :fiftyTopThirty, :fiftyMoreFirst, :fiftyMoreSecond, :fiftyMoreTopFour, :fiftyMoreTopHeight, :fiftyMoreTopSixteen, :fiftyMoreTopThirty)');
        $req->execute(array(
            'id_tournament' => $id_tournament,
            'twentyFirst' => htmlspecialchars($post['twentyFirst']),
            'twentySecond' => htmlspecialchars($post['twentySecond']),
            'twentyTopFour' => htmlspecialchars($post['twentyTopFour']),
            'twentyTopHeight' => htmlspecialchars($post['twentyTopHeight']),
            'thirtyFirst' => htmlspecialchars($post['thirtyFirst']),
            'thirtySecond' => htmlspecialchars($post['thirtySecond']),
            'thirtyTopFour' => htmlspecialchars($post['thirtyTopFour']),
            'thirtyTopHeight' => htmlspecialchars($post['thirtyTopHeight']),
            'thirtyTopSixteen' => htmlspecialchars($post['thirtyTopSixteen']),
            'fiftyFirst' => htmlspecialchars($post['fiftyFirst']),
            'fiftySecond' => htmlspecialchars($post['fiftySecond']),
            'fiftyTopFour' => htmlspecialchars($post['fiftyTopFour']),
            'fiftyTopHeight' => htmlspecialchars($post['fiftyTopHeight']),
            'fiftyTopSixteen' => htmlspecialchars($post['fiftyTopSixteen']),
            'fiftyTopThirty' => htmlspecialchars($post['fiftyTopThirty']),
            'fiftyMoreFirst' => htmlspecialchars($post['fiftyMoreFirst']),
            'fiftyMoreSecond' => htmlspecialchars($post['fiftyMoreSecond']),
            'fiftyMoreTopFour' => htmlspecialchars($post['fiftyMoreTopFour']),
            'fiftyMoreTopHeight' => htmlspecialchars($post['fiftyMoreTopHeight']),
            'fiftyMoreTopSixteen' => htmlspecialchars($post['fiftyMoreTopSixteen']),
            'fiftyMoreTopThirty' => htmlspecialchars($post['fiftyMoreTopThirty']),
        ));
    }

    public function addNewPlayer($post){
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('INSERT INTO registrations (idT, firstName, lastName, dci, comment) 
                            VALUES (:idT, :firstName, :lastName, :dci, :comment)');
        $req->execute(array(
            'idT' => $post['idt'],
            'firstName' => htmlspecialchars($post['firstName']),
            'lastName' =>htmlspecialchars($post['name']),
            'dci' => $post['dci'],
            'comment' => htmlspecialchars($post['commentDetail'])
        ));
    }
    
    public function getTournaments($id_user, $date, $status = 'open')
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        if ($status == 'open') {
          $req = $db->prepare('SELECT * FROM tournaments WHERE id_user = ? AND date >= ?'); 
        } else {
          $req = $db->prepare('SELECT * FROM tournaments WHERE id_user = ? AND date <= ?'); 
        }
        $req->execute(array($id_user, $date));
        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    public function cancelTournament($id, $id_user)
    {
        $database = dataBase::getInstance();
        $db = $database->dbConnect();
        $req = $db->prepare('UPDATE tournaments SET canceled = ? WHERE id = ? AND id_user = ?');
        $req->execute(array(
            true,
            $id,
            $id_user
        ));    
        return $req->rowCount();    
    }

}