<?php
class User
{

    public static function checkUserExistEmail($data)
    {
        $check = db::connecte()->prepare("select * from users where email = :email");
        $check->bindParam(":email", $data['email']);
        $check->execute();

        return $check->rowCount();
    }
    // 
    public static function checkUserExistUsername($data)
    {
        $check = db::connecte()->prepare("select * from users where username = :username");
        $check->bindParam(":username", $data['username']);
        $check->execute();

        return $check->rowCount();
    }
    //
    public static function checkUserExistEmailId($data)
    {
        $check = db::connecte()->prepare("select * from users where (email = :email and ID != :id)");
        $check->bindParam(":email", $data['email']);
        $check->bindParam(":id", $data['id']);
        $check->execute();

        return $check->rowCount();
    }
    // 
    public static function checkUserExistUsernameId($data)
    {
        $check = db::connecte()->prepare("select * from users where (username = :username and ID != :id)");
        $check->bindParam(":username", $data['username']);
        $check->bindParam(":id", $data['id']);
        $check->execute();

        return $check->rowCount();
    }
    public static function signUp($data)
    {
        $register = db::connecte()->prepare("insert into users(first_name,last_name,username,email,password,image,Admin,bio) values(:first_name,:last_name,:username,:email,:password,'default_profile_img.png',false,'')");
        $register->bindParam(":first_name", $data['first_name']);
        $register->bindParam(":last_name", $data['last_name']);
        $register->bindParam(":username", $data['username']);
        $register->bindParam(":email", $data['email']);
        $register->bindParam(":password", $data['password']);
      
       $register->execute();
            return true;
       
    }
    // 
    public static function updateImage($data)
    {
        $stmt = db::connecte()->prepare("update users set image = :image where ID = :id");
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":image", $data['image']);
        $stmt->execute();
            return true;
        
    }
    
    // 
   
    // 
    public static function checkUserExist($data)
    {

        $stmt = DB::connecte()->prepare("select * from users where email = :email or username = :username");
        $email = $data['email'];
        $username = $data['username'];

        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchObject();
        }
        return false;
    }
    // 
    public static function editProfile($data)
    {
        $edit = db::connecte()->prepare("update users set first_name = :first_name,last_name = :last_name,username = :username,email=:email,image = :image,bio = :bio where ID = :id");
        $edit->bindParam(":first_name", $data['first_name']);
        $edit->bindParam(":last_name", $data['last_name']);
        $edit->bindParam(":username", $data['username']);
        $edit->bindParam(":email", $data['email']);
        
      
        $edit->bindParam(":bio", $data['bio']);
        $edit->bindParam(":image", $data['image']);
        $edit->bindParam(":id", $data['id']);
        $edit->execute();
            return true;
        
        
    }
    //
    //  
    // 

    // 
    // Usrs
    public static function getAllUsers($id = null)
    {
        $stmt = null;
        if (is_null($id)) {
            $stmt = db::connecte()->prepare("select * from  users");
            $stmt->execute();
        } else {
            $stmt = db::connecte()->prepare("select * from  users where ID = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        }


        return $stmt->fetchAll();
    }

    // 
    public static function deleteUser($id)
    {

        $stmt = db::connecte()->prepare("delete from users where ID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
    
    //
    public static function getProfile($id)
    {
        $stmt = db::connecte()->prepare("select * from  users where ID = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }
    //
    public static function TopUsers($offset = null, $limit = null)
    {
        $stmt = db::connecte()->prepare("SELECT  u.* from users u , posts p where u.ID = p.ID_user group by u.ID order by COUNT(p.ID_post) desc limit :offset,:limit");
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //
    public static function TopUsersPages()
    {
        $stmt = db::connecte()->prepare("SELECT  u.* from users u , posts p where u.ID = p.ID_user group by u.ID order by COUNT(p.ID_post) desc");

        $stmt->execute();
        return [
            "result" => $stmt->fetchAll(),
            "rowCount" => $stmt->rowCount()
        ];
    }
}
