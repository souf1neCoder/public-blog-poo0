<?php
$catsController = new CategoryController();
$cats = $catsController->getCategoriesController();
if (isset($_POST['submit'])) {
    $add = new PostController();
    $add->addPostController();
}
?>
<script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<section class="add-post_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-5">
                <div class="forum">
                    <?php require_once './views/includes/Alert.php'; ?>

                    <div class="box_sign">
                        <h4>Create Post</h4>
                    </div>
                    <form class="my-4" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <select class="form-control" name="categorie" id="categorie">
                                <option value="">Select Category</option>
                                <?php foreach ($cats as $c) : ?>
                                    <option value="<?php echo $c['id_cat'] ?>"><?php echo $c['name_cat'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input placeholder="Post title" type="text" required autocomplete="on" size="200" max="200" name="post_title" id="post_title" class="form-control">
                        </div>
                        <div class="form-group ">

                            <textarea class="form-control mr-1" name="post_content" id="post_content"></textarea>

                        </div>
                        <div class="form-group">
                            <input type="file" class="border p-2" name="post_image">

                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn btn-dark">Create Post</button>
                        </div>
                    </form>
                    
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    CKEDITOR.replace('post_content', {
        
        removePlugins: 'sourcearea',
        removeButtons :'About'
       

    });
</script>
<script src="assets/js/textarea-resize.js"></script>