<?php
class Post
{
    public static function getPosts($offset = null, $limit = null)
    {
        $stmt = null;
        if (!is_null($offset) && !is_null($limit)) {
            $stmt = db::connecte()->prepare("select * from  posts order by ID_post desc limit :offset,:limit");
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        } else {
            $stmt = db::connecte()->prepare("select * from  posts order by ID_post desc limit 10");
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }
    // 
    public static function addPost($data)
    {

        $stmt = db::connecte()->prepare("insert into posts(post_title,post_content,post_author,post_date,ID_user,categorie,post_image) values(:post_title,:post_content,:post_author,now(),:ID_user,:categorie,:post_image)");
        $stmt->bindParam(":post_title", $data['post_title']);
        $stmt->bindParam(":post_content", $data['post_content']);
        $stmt->bindParam(":post_author", $data['post_author']);

        $stmt->bindParam(":ID_user", $data['ID_user']);
        $stmt->bindParam(":categorie", $data['categorie']);
        $stmt->bindParam(":post_image", $data['post_image']);
        $stmt->execute();
            return true;
       

        // 
    }
    // 
    public static function getPostById($id)
    {
        $stmt = db::connecte()->prepare("select * from  posts where ID_post = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
        
    }
    // 
    public static function getPostsByUser($id)
    {
        $stmt = db::connecte()->prepare("select * from  posts where ID_user = :id order by ID_post desc");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

            return $stmt->fetchAll();
        
    }
    // 
    public static function getPostsByCategory($category, $offset = null, $limit = null)
    {
        $stmt = null;
        if(is_null($limit) || is_null($offset)){
            $stmt = db::connecte()->prepare("select p.* from  posts p,categories c  where p.categorie = c.id_cat and c.name_cat = :cat order by p.ID_post desc ");
        }else{

            $stmt = db::connecte()->prepare("select p.* from  posts p,categories c  where p.categorie = c.id_cat and c.name_cat = :cat order by p.ID_post desc  limit :offset,:limit");
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        }
        $stmt->bindParam(":cat", $category);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // 
    public static function deletePost($id)
    {
        $stmt = db::connecte()->prepare("delete from  posts where ID_post = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

            return true;
        
    }
    // 
    public static function timeAgoPost($datetime, $full = false)
    {
        $now = new DateTime;
        // for my country
        $tosub = new DateInterval('PT1H');
        $ago = new DateTime($datetime, new DateTimeZone('UTC'));
        $ago->sub($tosub);
        $diff = $now->diff($ago);
       

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    //

    public static function getAllPosts($id = null)
    {
        $stmt = null;
        if (is_null($id)) {
            $stmt = db::connecte()->prepare("select * from  posts");
        } else {
            $stmt = db::connecte()->prepare("select * from  posts where ID_user = :id");
            $stmt->bindParam(":id", $id);
        }
        $stmt->execute();

            return $stmt->fetchAll();
        
    }
    public static function getPostsByComment($id = null)
    {

        $stmt = db::connecte()->prepare("select * from  posts where ID_post = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();

            return $stmt->fetchAll();
        
    }
    //
    public static function getCountCategoriesOfpost($id)
    {
        $stmt = db::connecte()->prepare("select count(*) from posts  where categorie  = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        return $stmt->fetchColumn();
    }
    //
    public static function getCountComments($id)
    {
        $stmt = db::connecte()->prepare("select count(*) from comments  where id_post  = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        return $stmt->fetchColumn();
    }
    //
    public static function getCountPostsOfUser($id)
    {
        $stmt = db::connecte()->prepare("select count(*) from  posts where ID_user = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    //
    public static function getAllPostLinks($id)
    {


        $stmt = db::connecte()->prepare("select * from  posts where ID_user = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    // 
    public static function getArticlesLimitRecent()
    {
        $stmt = db::connecte()->prepare("select * from  posts  order by ID_post desc ");
        $stmt->execute();
        return [
            "result" => $stmt->fetchAll(),
            "rowCount" => $stmt->rowCount()
        ];
    }
    //
    public static function getPostsByCategoryPages($category)
    {
        $stmt = db::connecte()->prepare("select p.* from  posts p,categories c  where p.categorie = c.id_cat and c.name_cat = :cat order by p.ID_post desc ");
        $stmt->bindParam(":cat", $category);
        $stmt->execute();
        return [
            "result" => $stmt->fetchAll(),
            "rowCount" => $stmt->rowCount()
        ];
    }
    //
    public static function addView($id)
    {
        $stmt = db::connecte()->prepare("update  posts set viewCount = viewCount + 1 where ID_post = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
    //
    public static function MostViewedArticles($offset = null, $limit = null)
    {
        $stmt = null;
        if (!is_null($offset) && !is_null($limit)) {
            $stmt = db::connecte()->prepare("select * from  posts where post_date > CURRENT_TIME - INTERVAL 30 DAY order by viewCount desc  limit :offset,:limit");
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } 
      
      
    }
     //
     public static function MostViewedArticlesPages()
     {
             $stmt = db::connecte()->prepare("select * from  posts where post_date > CURRENT_TIME - INTERVAL 30 DAY order by viewCount desc  ");
            
             $stmt->execute();
             return [
                "result" => $stmt->fetchAll(),
                "rowCount" => $stmt->rowCount()
            ]; 
     }
    //
    public static function FeaturedArticles($offset = null, $limit = null){
        $stmt = null;
        if (!is_null($offset) && !is_null($limit)) {
            $stmt = db::connecte()->prepare("select *  from posts p where (select count(*) from saves s  where s.ID_post = p.ID_post) > 0 group by p.ID_post order by (select count(*) from saves s  where s.ID_post = p.ID_post) desc limit :offset,:limit
            ");
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        } 
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //
     //
     public static function FeaturedArticlesPages()
     {
             $stmt = db::connecte()->prepare("select *  from posts p where (select count(*) from saves s  where s.ID_post = p.ID_post) > 0 group by p.ID_post order by (select count(*) from saves s  where s.ID_post = p.ID_post) desc");
        
             $stmt->execute();
             return [
                "result" => $stmt->fetchAll(),
                "rowCount" => $stmt->rowCount()
            ]; 
     }

}
