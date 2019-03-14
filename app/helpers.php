<?php


if (! function_exists('removeSpace')){


    function removeSpace ($string){

        $string = str_replace(' ', '', $string);

        return $string ;
    }


}