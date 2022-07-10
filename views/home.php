<?php
$postsController = new PostController();

    $posts = $postsController->getpostsController();

$saveController = new SaveController();
$categoriesController = new CategoryController();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<?php require_once './views/includes/main.php' ?>
<section class="posts_section mt-5">
    <div class="container-fluid">

        <div class="row mt-5">
            <div class="col-lg-9">
                <?php require_once './views/includes/Alert.php'; ?>
                <div class="row" id="arts">

                    <?php foreach ($posts as $i => $post) : ?>
                        <div class="col-lg-6 my-4 <?php echo ($i > 5) ? 'hideArt' : '' ?>">

                            <article class="article">
                                <div class="article_title py-1 my-1">
                                    <a href="<?php echo BASE_URL ?>?page=show&id_post=<?php echo $post['ID_post'] ?>">
                                        <?php if (strlen($post['post_title']) > 95) : ?>
                                            <?php echo substr($post['post_title'], 0, 98) . '...' ?>
                                        <?php else : ?>
                                            <?php echo $post['post_title'] ?>
                                        <?php endif ?>

                                    </a>
                                </div>
                                <div class="article_image">
                                    <img src="assets/images/posts/<?php echo $post['post_image'] ?>" class="article_img_src" alt="post image">

                                    <div class="save_box d-flex">
                                        <button class="btn btn-dark mx-2" type="button">
                                            <?php echo $postsController->getCountCommentsController($post['ID_post']) ?> <i class="fas fa-comment"></i>
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
                                <div class="article_body">
                                    <h6><?php echo $postsController->timeAgoController($post['post_date']) ?> - By <?php echo $post['post_author'] ?> - <?php echo $categoriesController->getCategoryByIdController($post['categorie']) ?></h6>
                                   


                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class=" text-center my-4">

                    <a  href="<?php echo BASE_URL ?>?page=posts-most-viewed"  class="btn btn-link text-decoration-underline">See More</a>

                </div>
            </div>
            <!-- ASIDE -->
            <div class="col-lg-3">
            <?php require_once './views/includes/aside.php' ?>
                
            </div>
            <!-- ASIDE -->
        </div>

    </div>
</section>
<script src="assets/js/save.js"></script>
<script src="assets/js/search.js"></script>

