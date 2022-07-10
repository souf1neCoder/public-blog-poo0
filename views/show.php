<?php
if (isset($_GET['id_post']) && !empty($_GET['id_post'])) {
    $id_post = filter_var( $_GET['id_post'], FILTER_SANITIZE_NUMBER_INT);
    $postController = new PostController();
    $postController->addViewContrlr($id_post);
    $post = $postController->getPostByIdController($id_post);
    $saveController = new SaveController();
    $categoriesController = new CategoryController();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    $commentContlr = new CommentsController();
    if(isset($_POST['deleteComment'])){
        $commentContlr->deleteCommentController($_POST['comment-id'],'show&id_post='.$id_post);
    }
    
} else {
    Redirect::to("home");
    exit;

}


?>

<section class="posts_section mt-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9">
                <?php require_once './views/includes/Alert.php'; ?>
                <article class="article show">
                                <div class="article_title py-1 my-1">
                                    <a href="#">
                                      <?php echo $post['post_title'] ?>
                                </a>
                                </div>
                                <div class="article_image">
                                    <img src="assets/images/posts/<?php echo $post['post_image'] ?>" class="article_img_src" alt="post image">
                                    <div class="save_box  d-flex">
                                    
                                    <button class="btn btn-dark mx-2" type="button">
                                            <?php echo $postController->getCountCommentsController($post['ID_post']) ?> <i class="fas fa-comment"></i>
                                        </button>
                                        <form method="post" class="save_form">
                                            <input type="hidden" name="id_post" id="id_post" value="<?php echo $post['ID_post'] ?>">
                                            <input type="hidden" name="id_user" id="id_user" value="<?php echo isset($user) ? $user->ID : ''  ?>">
                                            <?php if (isset($user)) : ?>
                                                <?php if ($saveController->checkSaved($post['ID_post'], $user->ID)) : ?>
                                                    <input type="hidden" id="opr_save" name="opr_save" value="false">
                                                    <button class="btn btn-dark" type="submit"><i class="fas fa-bookmark"></i></button>
                                                <?php else : ?>
                                                    <input type="hidden" id="opr_save" name="opr_save" value="true">
                                                    <button class="btn btn-dark" type="submit"><i class="far fa-bookmark"></i></button>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <input type="hidden" id="opr_save" name="opr_save" value="true">
                                                <button class="btn btn-dark" type="submit"><i class="far fa-bookmark"></i></button>
                                            <?php endif; ?>
            
            
                                        </form>
                                    </div>
                                </div>
                                <div class="article_body ">
                                    <h6><?php echo $postController->timeAgoController($post['post_date']) ?> - <?php echo $post['post_author'] ?> - <?php echo $categoriesController->getCategoryByIdController($post['categorie']) ?></h6>
                                   <div class="article_content">
                                       
                                        <?php echo html_entity_decode($post['post_content']) ?>
                                      
                                   </div>
                                 
                                   
                                </div>
                            </article>
               
                <div class="comment_panel mt-5">
                    <form method="post" id="commentForm">
                        <input type="hidden" name="id_post" id="id_post" value="<?php echo $post['ID_post'] ?>">
                       
                        <input type="hidden" name="id_user" id="id_user" value="<?php echo isset($user) ? $user->ID : ''  ?>">
                        <div class="row mx-0">

                            <textarea class="form-control rounded-0 col-lg-12" name="comment" id="comment" rows="2" class="comment_place" placeholder="write a comment"></textarea>
                            <button type="submit" name="submit" class="btn btn-dark col-lg-12 rounded-0">Post</button>
                        </div>
                    </form>
                </div>
                <ul class="list-group mt-3 " id="commentsList">
                                
                </ul>
            </div>
                                 <!-- ASIDE -->
            <div class="col-lg-3">
            <?php require_once './views/includes/aside.php' ?>

            </div>
            <!-- ASIDE -->
        </div>
    </div>
</section>
<script src="assets/js/comment.js"></script>
<script src="assets/js/search.js"></script>
