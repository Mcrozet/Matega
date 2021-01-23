<?php 

namespace Utils;

class TournamentsTools{
    
    /**
     * Print list of all registered in tournament
     *
     * @param [int] $id
     * @return void
     */
    /* function printList($id)
    {        
        $tournament = new \Models\Tournaments();
        
        $detail = $tournament->get('*', 'tournaments', 'id', $id);

        $registered = $tournament->getNumberRegistered($id);
        $registered = $registered->fetchAll(\PDO::FETCH_OBJ);

        require('views/tournaments/printList.php');
    } */

    function getTournamentInRangeCity($city, $range, $today)
    {
        $cities = new \Models\City();
        $tournament = new \Models\Tournaments();
        $distance = new CitiesTools();

        $chq = $cities->getCity($city);
        $getCitySearch = $chq->fetch(\PDO::FETCH_OBJ);
        
        $content = "";

        if($getCitySearch)
        {
            $citiesTournament = $tournament->getAllTournaments($today); 
            $citiesTournament = $citiesTournament->fetchAll(\PDO::FETCH_OBJ);
            
            for ($i=0; $i < count($citiesTournament); $i++) 
            { 
                $newCity = $citiesTournament[$i]->city;
                $coordTournois = $cities->getCity($newCity);
                $coordTournoi = $coordTournois->fetch(\PDO::FETCH_OBJ);
                            
                $meter = $distance->getDistance($getCitySearch->lon, $getCitySearch->lat, $coordTournoi->lon, $coordTournoi->lat);
                
                if($meter > ($range * -1) && $meter < $range)
                {
                    $content .= $citiesTournament[$i]->id . ", ";
                }
            }
        }
        return $content;
    }

    function getTournamentsInRangeDate($date1, $date2)
    {
        $tournaments = new \Models\Tournaments();

        $tournament = $tournaments->getTournamentsByDate($date1, $date2);
        $tournament = $tournament->fetchAll(\PDO::FETCH_OBJ);

        $content = "";

        for ($i=0; $i < count($tournament); $i++) 
        { 
            $content .= $tournament[$i]->id . ", ";
        } 

        return $content;
    }

    function getTournamentsLikeName($name)
    {
        $tournaments = new \Models\Tournaments();

        $tournament = $tournaments->getTournamentsByName($name);
        $tournament = $tournament->fetchAll(\PDO::FETCH_OBJ);

        $content = '';
        for ($i=0; $i < count($tournament); $i++) 
        { 
            $content .= $tournament[$i]->id . ", ";
        }
        return $content;
    }
}