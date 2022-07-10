<?php
class HomeController{
    public function index($page){
        require_once './views/'.$page.'.php';
    }
}