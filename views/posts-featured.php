<?php
$postsController = new PostController();
if (isset($_GET['hm']) && !empty($_GET['hm'])) {
    $hm = filter_var($_GET['hm'], FILTER_VALIDATE_INT);
} else {
    $hm = 1;
}
$limit = 6;
$offset = ($hm - 1) * $limit;


$posts = $postsController->FeaturedArticlesContrlr($offset, $limit);

$saveController = new SaveController();
$categoriesController = new CategoryController();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<section class="posts_section mt-5">
    <div class="container-fluid">

        <div class="row mt-5">
            <div class="col-lg-9">
                <?php require_once './views/includes/Alert.php'; ?>
                <h2 class="mt-5 mb-3 head_section">Featured <span class="logo_span">POO0</span></h2>
<div class="dropdown-divider"></div>
                <div class="row" id="arts">
                    <?php if (count($posts) > 0) : ?>
                        <?php foreach ($posts as $i => $post) : ?>
                            <div class="col-lg-6 my-4">

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
        <?php
        $totalArticlesRecent = $postsController->FeaturedArticlesPagesContrlr()['result'];
        $rowCount = $postsController->FeaturedArticlesPagesContrlr()['rowCount'];
        if ($rowCount > 0) {
            $total_page = ceil(count($totalArticlesRecent) / $limit);
            echo ' <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">';
            if ($hm > 1) {
                echo '<li class="page-item ">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm - 1) . '" tabindex="-1">Previous</a>
            </li>';
            } else {
                echo '<li class="page-item  disabled">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm - 1) . '" tabindex="-1">Previous</a>
            </li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                ($i == $hm) ? $active = "active" : $active = "";
                echo '<li class="page-item ' . $active . '">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . $i . '">' . $i . '</a>';
            }
            if ($total_page > $hm) {
                echo '<li class="page-item ">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm + 1) . '" >Next</a>
            </li>';
            } else {
                echo '<li class="page-item disabled">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm + 1) . '" >Next</a>
            </li>';
            }
            echo ' </ul>
            </nav>';
        }



        ?>


    </div>
</section>
<script src="assets/js/save.js"></script>
<script src="assets/js/search.js"></script>