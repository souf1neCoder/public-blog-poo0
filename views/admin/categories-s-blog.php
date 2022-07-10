<?php

$catContlr = new CategoryController();
$postCtrlr = new PostController();
$cats = $catContlr->getCategoriesController();
if (isset($_POST['submit'])) {
   $catContlr->deleteCategoriesController($_POST['cat-id']);
}
if (isset($_POST['add'])) {
   $catContlr->addCategoryController(ucfirst($_POST['name_cat']));
}

?>
<section class="users-s-blog mt-5">
    <div class="container">
        <h2 class="mt-5 mb-3">Categories POO0</h2>
        <div class="row">
            <div class="col-lg-12">
                <?php require_once './views/includes/Alert.php'; ?>
                <!-- add cat -->
                <form method="post">
                    <div class="form-group row">
                        
                        <input type="text" required  name="name_cat" placeholder="Name Of Category" class="form-control col-lg-4">
                        <button name="add" type="submit" class="btn btn-dark">Add</button>
                    </div>
                </form>
                <!--  -->
                <div class="table-responsive table-responsive-sm table-responsive-md">

                <table class="table table-hover text-center table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Count</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cats as $c) : ?>
                            <tr>
                                <th scope="row"><?php echo $c['id_cat'] ?></th>

                                <td>
                                    <?php echo $c['name_cat'] ?>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=posts-s-blog&category=<?php echo $c['name_cat'] ?>&admin=true">Posts</a>
                                </td>

                                <td>
                                    <?php echo $postCtrlr->getCountCategoriesOfPostController($c['id_cat']) ?>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="cat-id" value="<?php echo $c['id_cat'] ?>">
                                        <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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