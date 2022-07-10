<?php
class PostController
{
    public function getPostsController($offset=null,$limit=null)
    {
        $posts = Post::getPosts($offset,$limit);
        return $posts;
    }
    // 
    public function addPostController()
    {
        if(empty($_FILES['post_image']['name'])){
            SetAlert::set("danger", "Please select Image");
            Redirect::to("add-post");
            exit;
        } else if(empty($_POST['post_title']) || empty($_POST['post_content']) || empty($_POST['categorie'])){
            SetAlert::set("danger", "Please Fill all fields");
            Redirect::to("add-post");
            exit;
        }
        $post_author = $_SESSION['user']->username;
      
        $ID_user = $_SESSION['user']->ID;
        $imageFile = $_FILES['post_image'];
        $imageName = "post-" . date("h.i.sa") . "-" . $post_author . "-" . $imageFile['name'];
        $data = array(
            "post_title" => htmlentities($_POST['post_title']),
            "post_content" => htmlentities($_POST['post_content']),
            "post_author" => htmlentities($post_author),
            
            "ID_user" => $ID_user,
            "categorie" => htmlentities($_POST['categorie']),
            "post_image" => $imageName
        );
        if (Post::addPost($data)) {
            $name = $imageFile['name'];
            $tmp_name = $imageFile['tmp_name'];
            $size = $imageFile['size'];
            $target_dir = "assets/images/posts/";
            $target_file = $target_dir . basename($name);
            $extImage = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $formats = ['jpg', 'png', 'jpeg'];
            if (!in_array($extImage, $formats)) {
                SetAlert::set("danger", "Sorry, only JPG, JPEG, PNG files are allowed.");
                Redirect::to("add-post");
                exit;
            }
            if ($size > 1200000) {
                SetAlert::set("danger", "Image Size Is Too Large must be less Than 1.2mb");
                Redirect::to("add-post");
                exit;
            }
          
          

                move_uploaded_file($tmp_name, $target_dir . $imageName);
                SetAlert::set("success", "Post Created Successfully");
                Redirect::to("add-post");
           
        } else {
            SetAlert::set("danger", "Sorry Something wrong please try Again");
            Redirect::to("add-post");
        }
    }
    // 
    public function getPostByIdController($id)
    {
        $res = Post::getPostById($id);
        return $res;
    }
    // 
    public function getPostsByUserController($id)
    {
        $res = Post::getPostsByUser($id);
        return $res;
    }
    // 
    public function getPostsByCategoryController($category,$offset=null,$limit=null)
    {
        $posts = Post::getPostsByCategory($category,$offset,$limit);
        return $posts;
    }
    // 
    public function deletePostController($id, $user)
    {
        if (Post::deletePost($id)) {
            SetAlert::set("info", "Post deleted Successfully");
            header("location: " . BASE_URL . "?page=my-posts&id_user=" . $user);
        }
    }
    // 
    public function deletePostAdminController($id, $image)
    {
        $target_dir_posts = "assets/images/posts/";
        unlink($target_dir_posts.$image);
            Post::deletePost($id);
            SetAlert::set("info", "Post deleted Successfully");
            Redirect::to("posts-s-blog");
        }
    
    // 
    public function timeAgoController($date)
    {
        return Post::timeAgoPost($date);
    }
    //
    public function getAllPostsController()
    {
        $posts = null;
        if (isset($_GET['user-id'])) {

            $posts = Post::getAllPosts($_GET['user-id']);
        }
        else if(isset($_GET['category'])){
            $posts = Post::getPostsByCategory($_GET['category']);
        }
        else if(isset($_GET['post-id'])){
            $posts = Post::getPostsByComment($_GET['post-id']);
        }
        else{
            $posts = Post::getAllPosts();
        }
        return $posts;
    }
    //
    public function getCountCategoriesOfPostController($id){
        return Post::getCountCategoriesOfpost($id);
    }
    //
    public function getCountCommentsController($id){
        return Post::getCountComments($id);
    }
    //
    public function getCountPostsOfUserController($id){
        return Post::getCountPostsOfUser($id);
    }
    //
    public function getAllPostLinksController($id){
        return Post::getAllPostLinks($id);
    }
    //
    public function getArticlesLimitRecentContrlr(){
        return Post::getArticlesLimitRecent();
    }
   //
   public function addViewContrlr($id){
       
         Post::addView($id);
         
   }
   //
   public function getPostsByCategoryPagesContrlr($category){
        return Post::getPostsByCategoryPages($category);
   }
   //
   public function MostViewedArticlesContrlr($offset=null,$limit=null){
       return Post::MostViewedArticles($offset,$limit);
   }
    //
    public function FeaturedArticlesContrlr($offset=null,$limit=null){
        return Post::FeaturedArticles($offset,$limit);
    }
     //
   public function MostViewedArticlesPagesContrlr(){
    return Post::MostViewedArticlesPages();
}
  //
  public function FeaturedArticlesPagesContrlr(){
    return Post::FeaturedArticlesPages();
}
}
