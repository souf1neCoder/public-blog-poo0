<?php 
$searchTerm = htmlentities($_POST["search"]);
if(!empty($searchTerm)){
    $searchTerm = "%".$searchTerm."%";
    require_once "../database/db.php";
    require_once "../config/consts.php";

    $stmt = db::connecte()->prepare("SELECT * FROM posts WHERE post_title LIKE :s OR post_content LIKE :s");
    $stmt->bindParam(":s", $searchTerm);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $output = "";
    foreach($result as $post){
        strlen($post['post_title']) > 20 ? $title = substr($post['post_title'], 0, 17) . '...' : $title = $post['post_title'];
     
        $output .= "<a class='dropdown-item' href='".BASE_URL."?page=show&id_post=". $post['ID_post'] ."'>". $title . "</a>";
    }
    echo $output;
    
}