<?php
$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    Redirect::to("home");
    exit;
}
if (isset($_POST['submit'])) {
    if (
        $_POST['fname'] != $user->first_name ||
        $_POST['lname'] != $user->last_name ||
        $_POST['username'] != $user->username ||
        $_POST['email'] != $user->email ||
        
        $_POST['bio'] != $user->bio
    ) {

        $editController = new UserController();
        $editController->editController();
    } else {
        Redirect::to("profile");
        exit;
    }
}
if (isset($_FILES['image'])) {
    $updateImageController = new UserController();
    $updateImageController->updateImageController($_FILES['image']);
}
if (isset($_POST['deletePicture'])) {
    $deletePictureController = new UserController();
    $deletePictureController->deleteImageController();
}
?>
<section class="register_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">
                <?php require_once './views/includes/Alert.php'; ?>

                <form method="post" enctype="multipart/form-data" class="formUpload">
                    <div class="box_image">
                        <img src="assets/images/users/<?php echo $user->image ?>" alt="profile image">
                        <div class="round">
                            <input type="hidden" name="id" value="<?php echo $user->ID ?>">
                            <input type="hidden" name="nameCurrent" value="<?php echo $user->image ?>">
                            <input type="hidden" name="email" value="<?php echo $user->email ?>">
                            <input type="hidden" name="username" value="<?php echo $user->username ?>">
                            <input type="file" name="image" id="image">
                            <i class="fa fa-camera" style="color: #fff;"></i>
                        </div>
                    </div>
                </form>
                <?php if ($user->image !== "default_profile_img.png") : ?>
                    <form method="post" class="deleteForm">
                        <input type="hidden" name="email" value="<?php echo $user->email ?>">
                        <input type="hidden" name="username" value="<?php echo $user->username ?>">
                        <input type="hidden" name="id" value="<?php echo $user->ID ?>">
                        <input type="hidden" name="nameCurrent" value="<?php echo $user->image ?>">
                        <button type="submit" name="deletePicture" class="btn_remove">Delete Picture</button>
                    </form>
                <?php endif ?>
                <form action="#"  class="my-4" method="POST">
                    <div class="form-group row">
                        <label for="fname"  class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">

                            <input type="text" required autocomplete="on" name="fname" id="fname" value="<?php echo $user->first_name ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="lname"  class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            
                        <input type="text" required autocomplete="on" name="lname" id="lname" value="<?php echo $user->last_name ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username"  class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            
                            <input type="text" required autocomplete="on" name="username" value="<?php echo $user->username ?>" id="username" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username"  class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            
                            <input type="email" required autocomplete="on" name="email" id="email" value="<?php echo $user->email ?>" class="form-control">
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        <label for="bio"  class="col-sm-3 col-form-label">Bio</label>
                        <div class="col-sm-9">
                            
                            <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Bio..."><?php echo $user->bio ?></textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="submit" class="btn btn-dark btn-sign">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="assets/js/onchangeImage.js"></script>
<script src="assets/js/main.js"></script>
