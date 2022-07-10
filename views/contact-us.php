<?php

if (isset($_POST['contact'])) {
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $message = htmlentities($_POST['msg']);
    if (!empty($name) && !empty($email) && !empty($message)) {
        $contactController = new ContactController();
        $contactController->ContactUs($name, $email, $message);
    } else {
        SetAlert::set("danger", "Please fill all fields!");
        Redirect::to("contact-us");
    }
}
?>
<main class="main">
    <section class="contact_section ">
        <div class="container">
            <div class="my-3">

                <?php require_once './views/includes/Alert.php'; ?>
            </div>
            <div class="jumbotron mt-5">
         
          
                <h3 class="text-center title-head">Contact Us</h3>
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-8  col-md-10">
                        <form class="form_contact" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="msg">Message</label>
                                <textarea class="form-control" name="msg" id="msg" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn_confirm_final" name="contact">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>