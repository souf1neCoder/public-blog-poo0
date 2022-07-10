<?php
$userContlr = new UserController();
$users = $userContlr->getAllUsersController();
if(isset($_POST['submit'])){
    $userContlr->deleteUserController($_POST['user-id'],$_POST['user-image']);
}
?>
<section class="users-s-blog mt-5">
    <div class="container">
        <h2 class="mt-5 mb-3">Users POO0</h2>
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
                            <th scope="col">Fname</th>
                            <th scope="col">Lname</th>
                          
                            <th scope="col">Admin</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Comments</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <th scope="row"><?php echo $u['ID'] ?></th>
                            <td><img style="height: 2rem; width:2rem;" src="assets/images/users/<?php echo $u['image'] ?>" alt="img-user"></td>
                            <td><?php echo $u['first_name'] ?></td>
                            <td><?php echo $u['last_name'] ?></td>
                           
                            <td>
                                <?php if($u['Admin']): ?>
                                <input type="checkbox" onclick="return false;" checked  class="form-check-input">
                                <?php else: ?>
                                    <input type="checkbox"  onclick="return false;"  class="form-check-input">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=posts-s-blog&user-id=<?php echo $u['ID'] ?>&admin=true">Posts</a>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=comments-s-blog&user-id=<?php echo $u['ID'] ?>&admin=true">Comments</a>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="user-id" value="<?php echo $u['ID'] ?>">
                                    <input type="hidden" name="user-image" value="<?php echo $u['image'] ?>">
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