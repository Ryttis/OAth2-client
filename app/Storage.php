<?php

namespace App;

Class Storage
{
    private const FILE_NAME = __DIR__.'/user.json';

    public static function addUser($data)
    {   
        $file = json_encode($data);
   
        file_put_contents(self::FILE_NAME,$file);
    }
    public static function getUser()
    {
        $data = file_get_contents(self::FILE_NAME);
        $file = json_decode($data,true);
       
        return $file;
    }
    
  
}