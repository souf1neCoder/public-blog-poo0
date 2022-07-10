<?php
$userContlr = new UserController();
if (isset($_GET['hm']) && !empty($_GET['hm'])) {
    $hm = filter_var($_GET['hm'], FILTER_VALIDATE_INT);
} else {
    $hm = 1;
}
$limit = 6;
$offset = ($hm - 1) * $limit;
$users = $userContlr->TopUsersContrlr($offset,$limit);

?>
<section class="users-s-blog mt-5">
    <div class="container">
    

        <div class="row">
            <div class="col-lg-9">
                <?php require_once './views/includes/Alert.php'; ?>
                <!--  -->
                    <h2 class="mt-5 mb-3 head_section">Top Authors <span class="logo_span">POO0</span></h2>
<div class="dropdown-divider"></div>
                <?php if (count($users) > 0) : ?>
                    <div class="table-responsive table-responsive-sm table-responsive-md">
                    <table class="table table-hover text-center table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Img</th>
                                <th scope="col">Userame</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Profile</th>

                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($users as $u) : ?>
                                <tr>

                                    <td><img style="height: 2rem; width:2rem;" src="assets/images/users/<?php echo $u['image'] ?>" alt="img-user"></td>
                                    <td><?php echo $u['username'] ?></td>
                                    <td><?php echo $u['first_name'] ?></td>
                                    <td><?php echo $u['last_name'] ?></td>


                                    <td>
                                        <a class="btn btn-primary" href="<?php echo BASE_URL ?>?page=profile-of&user-id=<?php echo $u['ID'] ?>">See More</a>
                                    </td>


                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    </div>
                <?php else : ?>
                    <div class="mx-auto text-center mt-5 ">

                        <h4 class="text-muted fw-bold">Nothing Yet!</h4>
                    </div>
                <?php endif; ?>
                <!-- PAGINATION -->
                <?php


                $totalArticlesRecent = $userContlr->TopUsersPagesContrlr()['result'];
                $rowCount = $userContlr->TopUsersPagesContrlr()['rowCount'];

                if ($rowCount > 0) {
                    $total_page = ceil(count($totalArticlesRecent) / $limit);
                    echo '<div class="row mt-5 justify-content-center">';
                    echo ' <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">';
                    if ($hm > 1) {
                        echo '<li class="page-item ">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm - 1) . '" tabindex="-1">Previous</a>
            </li>';
                    } else {
                        echo '<li class="page-item  disabled">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm - 1) . '" tabindex="-1">Previous</a>
            </li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        ($i == $hm) ? $active = "active" : $active = "";
                        echo '<li class="page-item ' . $active . '">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . $i . '">' . $i . '</a>';
                    }
                    if ($total_page > $hm) {
                        echo '<li class="page-item ">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm + 1) . '" >Next</a>
            </li>';
                    } else {
                        echo '<li class="page-item disabled">
                <a class="page-link" href="' . BASE_URL . '?page=articles&hm=' . ($hm + 1) . '" >Next</a>
            </li>';
                    }
                    echo ' </ul>
            </nav>';
                    echo '</div>';
                }



                ?>
                <!-- PAGINATION -->
            </div>
            <!-- ASIDE -->
            <div class="col-lg-3">
                <?php require_once './views/includes/aside.php' ?>
            </div>
            <!-- ASIDE -->
        </div>
    </div>
</section>
<script src="assets/js/save.js"></script>
<script src="assets/js/search.js"></script>