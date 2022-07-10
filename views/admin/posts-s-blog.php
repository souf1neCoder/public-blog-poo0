<?php
$postContlr = new PostController();
$posts = $postContlr->getAllPostsController();

$categoriesController = new CategoryController();
if(isset($_POST['submit'])){
    $postContlr->deletePostAdminController($_POST['post-id'],$_POST['post-image']);
}

?>
<section class="users-s-blog mt-5">
    <div class="container">
        <h2 class="mt-5 mb-3">Posts POO0</h2>
        <div class="row">
            <div class="col-lg-12">
                <?php require_once './views/includes/Alert.php'; ?>
            <!--  -->
            <div class="table-responsive table-responsive-sm table-responsive-md">

                <table class="table table-hover text-center table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Img</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col">Date</th>
                            <th scope="col">Comments</th>
                            <th scope="col">User</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($posts as $p): ?>
                        <tr>
                            <th scope="row"><?php echo $p['ID_post'] ?></th>
                            <td><img style="height: 2rem; width:2rem;" src="assets/images/posts/<?php echo $p['post_image'] ?>" alt="img-user"></td>
                            <td><?php echo $p['post_title'] ?></td>
                            <td><?php echo $p['post_author'] ?></td>
                            <td><?php echo $categoriesController->getCategoryByIdController($p['categorie']) ?></td>
                           <td><?php echo $postContlr->timeAgoController($p['post_date']) ?></td>
                            
                            <td>
                                <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=comments-s-blog&post-id=<?php echo $p['ID_post'] ?>&admin=true">Comments</a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=users-s-blog&user-id=<?php echo $p['ID_user'] ?>&admin=true">User</a>
                            </td>
                            <td>
                            <form method="post">
                                    <input type="hidden" name="post-id" value="<?php echo $p['ID_post'] ?>">
                                    <input type="hidden" name="post-image" value="<?php echo $p['post_image'] ?>">
                                    <button type="submit" name="submit"  class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table></div>
            </div>
        </div>
    </div>
</section>