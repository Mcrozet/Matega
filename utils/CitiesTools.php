<?php 

namespace Utils;

class CitiesTools{

    /**
     * check distance with 2 points (tournament and city sended)
     *
     * @param [array] $get
     * @param [array] $post
     * @return void
     */
    function getDistance($lon1, $lat1, $lon2, $lat2)
    {        
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        $rlo1 = deg2rad($lon1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lon2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        //
        $meter = ($earth_radius * $d) / 1000;
    
        return $meter;
    }
    
}
