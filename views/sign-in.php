<?php
if (isset($_SESSION['user'])) {
    Redirect::to("home");
    exit;
}
if (isset($_POST['submit'])) {
    $loginController = new UserController();
    $loginController->loginController();
}
?>
<section class="login_section ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">
                
                <div class="forum">
                    <?php require_once './views/includes/Alert.php'; ?>

                    <div class="box_sign">
                        <h4>Sign In</h4>
                    </div>
                    <form  class="my-4"  action="#" method="POST">
                        <div class="form-group">
    
                            <label for="email">Email or Username</label>
                            <input type="text"  autocomplete="on" name="username/email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"  name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn  btn-dark ">Sign In</button>
                        </div>
                    </form>
                    <a class="text-muted text-center d-block text-decoration-underline" href="<?php echo BASE_URL ?>?page=sign-up">
                    <small>Create Account now</small></a>
                </div>
            </div>


        </div>
    </div>
    </div>
</section>