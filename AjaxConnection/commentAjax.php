<?php
$id_post = $_POST['id_post'];
$id_user = $_POST['id_user'];
$comment = htmlentities($_POST['comment']);
if(!empty($id_post)){
    if(!empty($id_user)){
        require_once "../database/db.php";
        $stmt = db::connecte()->prepare("insert into comments(comment,id_user,id_post,date_comment) values(:comment,:user,:post,now())");
            $stmt->bindParam(":post",$id_post);
            $stmt->bindParam(":user",$id_user);
            $stmt->bindParam(":comment",$comment);
            if($stmt->execute()){
                echo "done";
            }else{
                echo "failed";
            }
    }else{
    echo "User Id Not found";

    }
}else{
    echo "Post Id Not found";
}