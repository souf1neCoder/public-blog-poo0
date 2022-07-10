<?php
$catsController = new CategoryController();
$cats = $catsController->getCategoriesController();
?>
<div class="top-nav">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo_link">
            <a href="<?php echo BASE_URL ?>" class="navbar-brand">POO0</a>
        </div>
        <ul class="top_nav_list">
            <li class="nav-item smedia">
                <a class="nav-link" href="https://www.linkedin.com/in/soufiane-m-channa-8165b61a1/">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </li>
            <li class="nav-item smedia">
                <a class="nav-link" href="https://github.com/souf1neCoder">
                    <i class="fab fa-github"></i>
                </a>
            </li>
            <li class="nav-item smedia">
                <a class="nav-link" href="https://twitter.com/Soufianemchanna">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li class="nav-item smedia">
                <a class="nav-link" href="mailto:mchanna.soufiane@gmail.com"><i class="fas fa-envelope"></i></a>
            </li>
            <?php if (isset($_SESSION['logged']) && $_SESSION['logged']) : ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="image_profile_bar rounded-circle" src="./assets/images/users/<?php echo $_SESSION['user']->image ?>" alt="">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $postContlr = new PostController();
                        $saveCtrl = new SaveController();
                        $countSaves = $saveCtrl->getCountSavesOfUser($_SESSION['user']->ID);
                        $countPosts = $postContlr->getCountPostsOfUserController($_SESSION['user']->ID);
                        ?>
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>?page=profile"><i class="fas fa-user-alt"></i> Profile</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>?page=my-posts&id_user=<?php echo $_SESSION['user']->ID ?>"><i class="fas fa-newspaper"></i> My Posts (<?php echo  $countPosts; ?>)</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>?page=saved-posts&id_user=<?php echo $_SESSION['user']->ID ?>"><i class="fas fa-bookmark"></i> Save (<?php echo  $countSaves; ?>)</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']->Admin) : ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo BASE_URL ?>?page=admin-s-blog&id_user=<?php echo $_SESSION['user']->ID ?>&admin=true" class="btn">Admin</a>
                        <?php endif; ?>
                    </div>
                </li>


            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link text-decoration-underline" href="<?php echo BASE_URL ?>?page=sign-in">
                        Sign In
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-decoration-underline" href="<?php echo BASE_URL ?>?page=sign-up">
                        Sign Up
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>
<div class="categories_nav shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo BASE_URL ?>">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <?php foreach ($cats as $c) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL ?>?page=posts&hm=1&category=<?php echo $c["name_cat"] ?>"><?php echo $c["name_cat"] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    </div>
</div>