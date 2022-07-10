<?php

$commentContlr = new CommentsController();

$comments = $commentContlr->getAllCommentsController();
if(isset($_POST['submit'])){
    $commentContlr->deleteCommentController($_POST['comment-id'],'comments-s-blog');
}

?>
<section class="users-s-blog mt-5">
    <div class="container">
        <h2 class="mt-5 mb-3">Comments POO0</h2>
        <div class="row">
            <div class="col-lg-12">
                <?php require_once './views/includes/Alert.php'; ?>
            <!--  -->
            <div class="table-responsive table-responsive-sm table-responsive-md">

                <table class="table table-hover text-center table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Post</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Author(Post)</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($comments as $c): ?>
                        <tr>
                            <th scope="row"><?php echo $c['ID_comment'] ?></th>
                           
                            <td>
                                <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=users-s-blog&user-id=<?php echo $c['id_user'] ?>&admin=true">User</a>
                                </td>
                            <td>
                            <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=posts-s-blog&post-id=<?php echo $c['id_post'] ?>&admin=true">Post</a>
                                </td>
                            <td><?php echo $c['comment'] ?></td>
                            <td><?php echo $commentContlr->getAuthorOfCommentContrlr($c['ID_comment']) ?></td>
                            
                           <td><?php echo $c['date_comment'] ?></td>
                            
                         
                            <td>
                            <form method="post">
                                    <input type="hidden" name="comment-id" value="<?php echo $c['ID_comment'] ?>">
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