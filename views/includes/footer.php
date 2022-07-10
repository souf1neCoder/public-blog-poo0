<!-- Footer -->
<div class="footer">

    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="mx-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->
    
            <!-- Right -->
            <div class="smediaFooter">
              <a class="mx-4 text-reset" href="https://www.linkedin.com/in/soufiane-m-channa-8165b61a1/">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a class="mx-4 text-reset" href="https://github.com/souf1neCoder">
              <i class="fab fa-github"></i>
    
              </a>
              <a class="mx-4 text-reset" href="https://twitter.com/Soufianemchanna">
                <i class="fab fa-twitter"></i>
              </a>
              <a class="mx-4 text-reset" href="mailto:mchanna.soufiane@gmail.com"><i class="fas fa-envelope"></i></a>
               
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->
    
        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                        POO0
                        </h6>
                        <p>
                        Feel Free to Type about Passion, Life, Experiences, Knowledge... You can share your thoughts and experiences with others.
                        </p>
                    </div>
                    <!-- Grid column -->
    
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Categories
                        </h6>
                        <?php foreach ($cats as $c) : ?>
    
                            <p>
                                <a href="<?php echo BASE_URL ?>?page=posts&hm=1&category=<?php echo $c["name_cat"] ?>" class="text-reset"><?php echo $c["name_cat"] ?></a>
                            </p>
                        <?php endforeach; ?>
    
                    </div>
                    <!-- Grid column -->
    
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
    
                            <a class="text-reset" href="<?php echo BASE_URL ?>?page=posts&hm=1">Recent Articles</a>
                        </p>
                        <p>
    
                            <a class="text-reset" href="<?php echo BASE_URL ?>?page=posts-most-viewed&hm=1">Most Viewd</a>
                        </p>
                        <p>
    
                            <a class="text-reset" href="<?php echo BASE_URL ?>?page=posts-featured&hm=1">Featured</a>
                        </p>
                        <p>
    
                            <a class="text-reset" href="<?php echo BASE_URL ?>?page=top-authors">Authors</a>
                        </p>
                        <p>
    
                            <a class="text-reset" href="<?php echo BASE_URL ?>?page=contact-us">Contact Us</a>
                        </p>
                    </div>
                    <!-- Grid column -->
    
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->
    
        <!-- Copyright -->
        <div class="text-center p-4 copyright">
            © <?php echo date("Y"); ?> Copyright
            <a class="text-reset fw-bold" href="<?php echo BASE_URL ?>">POO0</a>
        </div>
        <!-- Copyright -->
    </footer>
</div>
<!-- Footer -->


<!-- scripts js -->
<script>

    let h_alert = document.querySelector('.alert');
        function hideAlert(){
            if(h_alert){
                h_alert.remove();
            }
        }
        setTimeout(hideAlert,3000);
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>