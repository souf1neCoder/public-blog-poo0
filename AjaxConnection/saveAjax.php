<?php
$id_post = $_POST['id_post'];
$id_user = $_POST['id_user'];
$opr_save = $_POST['opr_save'];
if(!empty($id_post)){
    if(!empty($id_user)){
        require_once "../database/db.php";
        if($opr_save === "true"){
            $stmt = db::connecte()->prepare("insert into saves(ID_post,ID_user) values(:post,:user)");
            $stmt->bindParam(":post",$id_post);
            $stmt->bindParam(":user",$id_user);
            if($stmt->execute()){
                echo "done save";
            }else{
                echo "failed save";
            }
        }else if($opr_save === "false"){
            $stmt = db::connecte()->prepare("delete from saves where  ID_post = :post");
            $stmt->bindParam(":post",$id_post);
            if($stmt->execute()){
                echo "done unsave";
            }else{
                echo "failed unsave";
            }
        }
    }else{
    echo "User Id Not found";

    }
}else{
    echo "Post Id Not found";
}