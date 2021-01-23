<?php 

// display page tournament 
function tournament($get)
{
    $tournaments = new Models\Tournaments();
    $registrations = new Models\Registrations();
    $arrayTool = new Utils\ArrayTools();

    if(isset($get['registered']) AND $get['registered'] == "true")
    {
        echo '<script>alert("Félicitations ! Inscription enregistrée");</script>';        
    }

    $tournament = $tournaments->getOne('*', 'tournaments', 'id', $get['id']);

    $today = date('Y-m-d');

    // If we dont have tournament, that's someone change url, so return to home
    if(!$tournament)
    {
        header('location:home');
    }
    else
    {
        $tournamentDetail = $tournaments->getOne('*', 'tournament_details', 'id', $get['id']);

        $registration = count($registrations->getAll('*', 'registrations', 'id_tournament', $get['id']));

        $rewardsName = array("First", "Second", "TopFour", "TopHeight", "TopSixteen", 'TopThirty');
        $topName = array('1er', '2eme', 'Top 4', 'Top 8', 'Top 16', 'Top 32');
        $extras = array("Buvette", "Vendeur", "Biere", "Alterateur", "Tombola");

        if($registration >= 0 && $registration < 20)
        {
            $top = "twenty";
            $next = "thirty";
            $nextNumbersPlayers = 20;

        }elseif($registration >= 20 && $registration < 30)
        {
            $top = "thirty";
            $next = "fifty";
            $nextNumbersPlayers = 30;

        }elseif($registration >= 30 && $registration < 50)
        {
            $top = "fifty";
            $next = "fiftyMore";
            $nextNumbersPlayers = 50;

        }else
        {
            $top = "fiftyMore";
        }
 
        $rewards = $tournaments->getOne('*', 'rewards', 'id', $get['id']);

        $content = $arrayTool->decodeStringTinyMce($tournamentDetail->content);
        
        require('views/tournaments/tournament.php');
    }
}

/* displays the page for creating new tournaments */
function newTournament()
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    require('views/tournaments/createTournament.php');
}

/* display all tournaments where cities are in range sended */
function searchByCity($get, $post)
{
    $city = $post['city'];
    $range = $post['range'];
    $today = date("Y-m-d");

    $TournamentsTools = new Utils\TournamentsTools();
    $TournamentInRangeCity = $TournamentsTools->getTournamentInRangeCity($city, $range, $today);

    echo $TournamentInRangeCity;
}

/* display all tournaments where dates are in range sended */
function searchByDate($get, $post)
{
    $date1 = $post['date1'];
    $date2 = $post['date2'];

    $tournamentsTools = new Utils\TournamentsTools();
    $tournamentsInRangeDate = $tournamentsTools->getTournamentsInRangeDate($date1, $date2);
    echo $tournamentsInRangeDate;
}

/* display all tournaments where name like .. */
function searchByName($get, $post)
{
    $name = $post['name'];
    $tournamentsTools = new Utils\TournamentsTools();

    $content = $tournamentsTools->getTournamentsLikeName($name);
    echo $content;
}

/* Display tournaments created by this user */
function userEvents($get)
{
    $userTool = new Utils\UserTools();
    $user = new Models\User();
    $databaseObject = new Models\DatabaseObject();
    $adress = new Models\City();
    $tournament = new Models\Tournaments();
    $date = new \dateTime();

    $userTool->userIsConnected();
    $adresses = $adress->getAdressByIdUser($_SESSION['id']);
    $user = $user->getOne('*', 'profil', 'id_user', $_SESSION['id']);
    $date = $date->format('Y-m-d');
    $tournamentsCreated = $tournament->getTournaments($_SESSION['id'], $date, 'open');
    $tournamentsFinished = $tournament->getTournaments($_SESSION['id'], $date, 'closed');

    if(isset($get['id']) AND is_numeric($get['id'])){
        $datasBank = $databaseObject->getOne('*', "bankdatas", "idUser", $_SESSION['id']);
        require("views/tournaments/addPayment.php");
    }
    else{
        require("views/tournaments/myEvents.php");
    }
}

/* Add a new adress in user profil */
function addNewAdress($get, $post)
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    $city = new Models\City();
    $name = htmlspecialchars($post['name']);
    $location = htmlspecialchars($post['localisation']);
    $ville = htmlspecialchars($post['city']);
    $cp = htmlspecialchars($post['cp']);

    $addressExist = $city->getAdressByIdUser($_SESSION['id']);
    $exist = false;
    for ($i=0; $i < count($addressExist); $i++) { 
        if($addressExist[$i]->name == $name)
        {
            $exist = true;
            echo "Ce Nom est déjà présent dans vos adresses";
            break;
        }
    }

    if(!$exist)
    {        
        echo "Votre adresse a bien été ajoutée";
        $city->addNewAdress($_SESSION['id'], $name, $location, $cp, $ville);
    }
}

/* Change adresse used in tournament when create one */
function changeAdressDefault($get, $post)
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    $city = new Models\City();
    $result = $city->getAdressByIdUserAndId($_SESSION['id'], $post['id']);
    echo json_encode($result);
}

/* Add new tournament in DB */
function createTournament($get, $post)
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    $dates = explode(",", $post['datePicker']);
    $extras = array ('buvette', 'biere', 'vendeur', 'alterateur', 'tombola');
    for ($i=0; $i < count($dates); $i++) {   
        for ($a=0; $a < count($extras); $a++) { 
            if(isset($post[$extras[$a]]))
            {
                $post[$extras[$a]] = 1;
            }
            else{
                $post[$extras[$a]] = 0;
            }
        }      
        $tournament = new Models\Tournaments();
        $added = $tournament->addTournament($post, date('Y-m-d', strtotime($dates[$i])));
        $tournament->addDetails($post, $added['LAST_INSERT_ID()']);
        $tournament->addRewards($post, $added['LAST_INSERT_ID()']);
    }
    header('location: userEvents-'.$added['LAST_INSERT_ID()']);
}

/* Display page tournament only for the creator*/
function detailstournament($get, $post)
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    $id = $get['id'];
    require('views/tournaments/tournamentDetail.php');
}

/* Cancel a tournament */
function cancelTournament($get)
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    $id = $get['id'];
    $tournament = new Models\Tournaments();
    if($tournament->cancelTournament($id, $_SESSION['id']) == 1)
    {
        header('location:userEvents-Canceled');
    }
    else
    {
        header('location:userEvents-errorCode');
    }

}