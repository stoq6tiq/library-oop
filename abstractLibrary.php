<?php

/**
 * Created by PhpStorm.
 * User: stoi
 * Date: 22.8.2022 г.
 * Time: 22:29
 */
 class abstractLibrary
{
     /**
      * @param $string
      * @return string
      */
     static function convertDirectorySeparator($to_convert){

        if(!empty(strstr($to_convert,DIRECTORY_SEPARATOR)))
        {
            $for_replase = "/" === DIRECTORY_SEPARATOR ? "\\" : "/" ;
            $to_convert = str_replace($for_replase,DIRECTORY_SEPARATOR,$to_convert);
        }

        return $to_convert;

    }

}