<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(-1);
ob_start();
require_once './config/autoload.php';
require_once './config/consts.php';
$home = new HomeController();
$page = "home";
$pagesNotLogged = ['sign-in', 'sign-up', 'home', 'active', 'show', 'profile-of','posts','posts-most-viewed','posts-featured','top-authors','contact-us'];
$pagesLogged = ['profile', 'add-post', 'delete-post', 'edit-post', 'edit-profile', 'logout', 'my-posts', 'admin', 'saved-posts'];
$pagesLoggedAdmin = ['admin-s-blog', 'users-s-blog', 'posts-s-blog', 'comments-s-blog', 'categories-s-blog'];
// GET PAGE TO INCLUDE
if (isset($_GET['page']) && !empty($_GET['page'])) {
    if (in_array($_GET['page'], $pagesNotLogged)) {

        $page = $_GET['page'];
    } else if (in_array($_GET['page'], $pagesLogged)) {
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            $page = $_GET['page'];
        } else {
           
            Redirect::to("sign-in");
            
        }
    } else if (in_array($_GET['page'], $pagesLoggedAdmin)) {
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            if (isset($_SESSION['user']) && $_SESSION['user']->Admin) {

                global $home;
                $home = new AdminController();
                $page = $_GET['page'];
            } else {
                Redirect::to("404");
            }
        } else {
            Redirect::to("sign-in");
   
        }
    } else {
        $page = "404";
    }
}

require_once './views/includes/header.php';
require_once './views/includes/nav.php';

$home->index($page);
require_once './views/includes/footer.php';
