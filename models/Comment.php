<?php
class Comment{
    public static function getAllComments(){
        $stmt = db::connecte()->prepare("select * from  comments");
        $stmt->execute();

            return $stmt->fetchAll();
        
    }
    public static function getCommentsByUser($id){
        $stmt = db::connecte()->prepare("select * from  comments where id_user = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();

            return $stmt->fetchAll();
        
    }
    public static function getCommentsByPost($id){
        $stmt = db::connecte()->prepare("select * from  comments where id_post = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();

            return $stmt->fetchAll();
        
    }
    // 
    public static function getAuthorOfComment($id){
        $stmt = db::connecte()->prepare("select p.post_author from posts p,comments c where c.id_post = p.ID_post and c.ID_comment = :id");
        $stmt->bindParam(":id",$id);

        $stmt->execute();
        return $stmt->fetchColumn();
    }
   
    public static function deleteComment($id){
        $stmt = db::connecte()->prepare("delete from comments where ID_comment = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    }
}