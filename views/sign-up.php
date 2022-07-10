<?php

if (isset($_POST['submit'])) {
    $userController = new UserController();
    $userController->signUpController();
}
?>
<section class="register_section ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">
                <div class="forum">
                    <?php require_once './views/includes/Alert.php';?>

                    <div class="box_sign">
                        <h4>Sign Up</h4>
                    </div>
                    <form  class="my-4"  action="#" method="POST">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text"  autocomplete="on" name="fname" id="fname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text"  autocomplete="on" name="lname" id="lname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text"  autocomplete="on" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text"  autocomplete="on" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"  name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn btn-dark">Sign Up</button>
                        </div>
                    </form>
                    <a class="text-muted text-center d-block text-decoration-underline"  href="<?php echo BASE_URL ?>?page=sign-in"><small>Already Have an Account</small></a>
                </div>
            </div>
        </div>
    </div>
</section>
