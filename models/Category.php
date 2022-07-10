<?php
class Category{
    public static function getCategories(){
        $stmt = db::connecte()->prepare("select * from categories");
        $stmt->execute();
            return $stmt->fetchAll();
           
    }
    // 
    public static function getCategoryById($id){
        $stmt = db::connecte()->prepare("select name_cat from categories where id_cat = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return $stmt->fetch();
        
    }
    //
    public static function deleteCategories($id){
        $stmt = db::connecte()->prepare("delete from categories where id_cat = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    }
    //
    public static function addCategory($name){
        $stmt = db::connecte()->prepare("insert into  categories(name_cat) values(:name)");
        $stmt->bindParam(":name",$name);
        $stmt->execute();
    }

}