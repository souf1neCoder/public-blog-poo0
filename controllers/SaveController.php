<?php
class SaveController
{
    public function checkSaved($id_post, $id_user)
    {
        $stmt = DB::connecte()->prepare("select * from saves where ID_post = :id_post and ID_user = :id_user");
        $stmt->bindParam(":id_post", $id_post);
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    // 
    public function getSavedPostsByUser($id_user)
    {
        $stmt = DB::connecte()->prepare("select P.* from posts P,saves S where S.ID_user = :id_user and S.ID_post = P.ID_post order by S.ID_save desc");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    //
    public static function getCountSavesOfUser($id)
    {
        $stmt = db::connecte()->prepare("select count(*) from  saves where ID_user = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
}
