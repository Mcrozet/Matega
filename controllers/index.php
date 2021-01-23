<?php

/**
 * Header home if error
 *
 * @return void
 */
function error()
{
    header('location:home');
}

/**
 * Home
 *
 * @param  mixed $get
 *
 * @return void
 */
function home($get)
{
    $tournament = new Models\Tournaments();
    $user = new Models\User();
    $databaseObject = new Models\DatabaseObject();
    $filterTool = new Utils\FilterTool();
    $arrayTool = new Utils\ArrayTools();

    $formats = ["vintage", "legacy", "modern", "standard", "commander", "other"];

    if(isset($_SESSION['city']))
    {
        $city = $_SESSION['city'];
    }
    else
    {
        $city = '';
    }

    $today = date("Y-m-d");

    if(isset($get['page'])){
        $page = $get['page'];
    }
    else{
        $page = 1;
    }

    $limit = (($page - 1) * 9) . ', 9';

    /* If user have preference in his profil for tournament formats, then display tournaments */
    if(isset($_SESSION['id']))
    {
        $profil = $databaseObject->getOne('*', 'profil', 'id_user', $_SESSION['id']);
        
        $filter = $filterTool->filterUsedByUser($profil, $formats);

        if($filter){
            $results = $tournament->getAllTournaments($today, $limit, $filter);    
        }
        else{
            $results = $tournament->getAllTournaments($today, $limit);    
        }
    }
    else
    {
        $results = $tournament->getAllTournaments($today, $limit);    
    }

    /* Get all tournaments and return one tournament if 2 or more tournaments have the same name */
    $tournaments = $results->fetchAll(\PDO::FETCH_OBJ);
    $uniqueTournament = $arrayTool->RemoveDuplicates($tournaments);


    /* On place tout ca dans une variable tournaments, on compte le nombre de page et on affiche la page */
    $tournaments = $uniqueTournament;
    $count = count($tournaments);
    $nmbrPage = ceil($count / 9); 
    
    $format = [];
    for ($i=0; $i < count($formats); $i++) 
    {         
        $format[$i] = $tournament->getAllTournamentsByFormat($today, $formats[$i]);        
        $format[$i] = $format[$i]->fetchAll(\PDO::FETCH_OBJ);
    }
    
    require('views/index.php');
    echo "<script>$('#link$page').css({
        'background-color': '#FF9100'
    });</script>";
}

/**
 * Check if data sended is city
 *
 * @param [array] $get
 * @param [array] $post
 * @return void
 */
function isCity($get, $post)
{
    $city = new Models\City();
    $req = $city->isCity($post['inputCity']);
    $cities = $req->fetchAll(\PDO::FETCH_OBJ);
    for ($i=0; $i < count($cities); $i++) 
    { 
        echo '<span onclick="resultCity(' . $cities[$i]->id . ')">' . $cities[$i]->name . '</span><br />';
    }
}

/**
 * Function called by Js to get cityname 
 *
 * @param [array] $get
 * @param [array] $post
 * @return string
 */
function resultCity($get, $post)
{
    $city = new Models\city();
    $cityR = $city->getOne('*', 'cities', 'id', $post['id']);
    $_SESSION['cityID'] = $cityR->id;
    echo $cityR->name;
}