<?php
class Redirect{
    public static function to($page){
        header("Location: ".BASE_URL."?page=".$page);
    }
}