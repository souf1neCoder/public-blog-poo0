<?php
if (isset($_GET['id_user']) && !empty($_GET['id_user'])) {

    $id_post = filter_var($_GET['id_user'], FILTER_SANITIZE_NUMBER_INT);
    $postController = new PostController();
    $posts = $postController->getPostsByUserController($id_post);
    $saveController = new SaveController();
    $categoriesController = new CategoryController();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
} else {
    Redirect::to("home");
    exit;
}
if (isset($_POST['submit'])) {
    $postController = new PostController();
    $postController->deletePostController($_POST['id_post'], $_POST['id_user']);
}
?>
<section class="posts_section mt-5">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-lg-9">
                <?php require_once './views/includes/Alert.php'; ?>
                <h2 class="mt-5 mb-3 head_section">My Posts <span class="logo_span">POO0</span></h2>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <?php if (count($posts) > 0) : ?>

                        <?php foreach ($posts as $i => $post) : ?>
                            <div class="col-lg-6 my-4">

                                <article class="article">
                                    <div class="article_title py-1 my-1">
                                        <a href="<?php echo BASE_URL ?>?page=show&id_post=<?php echo $post['ID_post'] ?>">
                                            <?php if (strlen($post['post_title']) > 65) : ?>
                                                <?php echo substr($post['post_title'], 0, 70) . '...' ?>
                                            <?php else : ?>
                                                <?php echo $post['post_title'] ?>
                                            <?php endif ?>

                                        </a>
                                    </div>
                                    <div class="article_image">
                                        <img src="assets/images/posts/<?php echo $post['post_image'] ?>" class="article_img_src" alt="post image">

                                        <div class="save_box d-flex">
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
                                            <form method="post">
                                                <input type="hidden" name="id_post" value="<?php echo $post['ID_post'] ?>">
                                                <input type="hidden" name="id_user" value="<?php echo $post['ID_user'] ?>">
                                                <button type="submit" class="btn btn-dark mx-2" name="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="article_body">
                                        <h6><?php echo $postController->timeAgoController($post['post_date']) ?> - <?php echo $post['post_author'] ?> - <?php echo $categoriesController->getCategoryByIdController($post['categorie']) ?></h6>



                                    </div>

                                </article>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="mx-auto text-center mt-5 ">

                            <h4 class="text-muted fw-bold">Nothing Yet!</h4>
                        </div>
                    <?php endif; ?>
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