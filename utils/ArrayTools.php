<?php 

namespace Utils;

class ArrayTools{

    function RemoveDuplicates($arrayProcessing)
    {
        $arrayUniquesDatas = [];
        for ($i=0; $i < count($arrayProcessing); $i++) { 
            $in = false;
            for ($a=0; $a < count($arrayUniquesDatas); $a++) 
            { 
                if($arrayProcessing[$i]->name == $arrayUniquesDatas[$a]->name)
                {
                    $in = true;
                    break;
                }
                else
                { 
                    $in = false;
                }
            }
            if(!$in)
            {
                array_push($arrayUniquesDatas, $arrayProcessing[$i]);
            }    
        }
        return $arrayUniquesDatas;
    }

    function decodeStringTinyMce($string)
    {
        $array1 = array('&lt;', '&gt;', '&quot;', '&amp;', '&eacute;', '&#39;', '&egrave;', '&ccedil;', '&agrave;', '=&nbsp;');
        $array2 = array('<', '>', '"', '&', 'é', '\'', 'è', 'ç', 'à', '=');

        $content = str_replace($array1, $array2, $string);
        return $content;
    }
}