<main class="main">
    <div class="hero_main d-flex justify-content-center align-items-center">
        <div class="welcome text-center w-75">
           
            <h1>Welcome to <span>POO0</span>, Feel Free to Type about Passion, Life, Experiences, Knowledge...</h1>
          
            <p>With <span>POO0</span> You can share your thoughts and experiences with others.</p>
            <?php if (isset($_SESSION['logged']) && $_SESSION['logged']) : ?>
                <button class="btn btn_scroll">See More</button>
            <?php else : ?>
                <a class="btn" href="<?php echo BASE_URL ?>?page=sign-in">Sign Up Now</a>
            <?php endif; ?>
        </div>
    </div>
</main>
<script>
    const btn = document.querySelector(".btn_scroll");


    btn.addEventListener("click", () => {
        scrollTo(0, window.innerHeight)
    });
</script>