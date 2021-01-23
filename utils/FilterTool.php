<?php 

namespace Utils;

class FilterTool{
    
    /**
     * Return all filter used by user
     *
     * @param [object] $profil
     * @param [array] $formats
     * @return string 
     */
    function filterUsedByUser($profil, $formats)
    {       
        for ($i=0; $i < count($formats); $i++) { 
            $a = $formats[$i];
            if($profil->$a == 1)
            {
                if(isset($filter))
                {
                    $filter = $filter . " OR format = '".$a."'";
                }
                else
                {
                    $filter = "format = '".$a."'";
                }
            }
        }
        if(isset($filter)){
            return $filter;
        }
    }
}