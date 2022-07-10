<?php
if (isset($_GET['user-id']) && !empty($_GET['user-id'])) {

    $id_user = filter_var($_GET['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $userContlr = new UserController();
    $profile = $userContlr->getProfileController($id_user);
    $postContlr = new PostController();
     $countPosts = $postContlr->getCountPostsOfUserController($id_user);
    $posts = $postContlr->getAllPostLinksController($id_user);

} else {
    Redirect::to("home");
    exit;
}
?>

<section class="profile-of_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">

                <div class="box_image">
                    <img src="assets/images/users/<?php echo $profile['image'] ?>" alt="profile image">

                </div>
                <div class="info_of_profile my-3 text-center">
                    <h2 class="mb-2"><?php echo $profile['first_name'] ?> <?php echo $profile['last_name'] ?></h2>
                    <h5>"<?php echo $profile['bio'] ?>" - <?php echo $profile['username'] ?></h5> 
                </div>
                <h2 class="mb-3 head_section" >Articles (<?php echo $countPosts ?>)</h2>
                <ul>
                <?php if (count($posts) > 0) : ?>

                    <?php foreach($posts as $p): ?>
                        <a class="d-block mb-2" href="<?php echo BASE_URL ?>?page=show&id_post=<?php echo $p['ID_post'] ?>"><?php echo $p['post_title'] ?></a>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <div class="mx-auto text-center mt-5 ">

                        <h4 class="text-muted fw-bold">Nothing Yet!</h4>
                    </div>
                <?php endif; ?>
                </ul>

            </div>
        </div>
    </div>
</section>
