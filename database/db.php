<?php
class db
{


    public static function connecte()
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=blog", "root", "");
            $db->exec("set names utf8");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $db;
        } catch (PDOException $er) {
            echo $er->getMessage();
        }
    }
}
