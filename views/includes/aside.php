<aside>
                    <div class="add_button_box mt-4"><a href="<?php echo BASE_URL ?>?page=add-post" class="btn ">Create Post</a>
                    </div>
                    <form id="searchForm" autocomplete="off">
                        <div class="form-group mt-3 mb-1">

                            <input type="text" name="search" class="form-control" placeholder="Search ...">


                        </div>
                        <ul class="list-group" id="listResults">

                        </ul>
                    </form>
                    
                    <ul class="list-group list-group-flush text-center mt-5 mb-2">
                        <a class="link_aside <?php echo $page == 'posts' ? 'active' : '' ?>" href="<?php echo BASE_URL ?>?page=posts&hm=1">Recent Posts</a>
                        <a class="link_aside <?php echo $page == 'posts-most-viewed' ? 'active' : '' ?>" href="<?php echo BASE_URL ?>?page=posts-most-viewed&hm=1">Most Viewd</a>
                        <a class="link_aside <?php echo $page == 'posts-featured' ? 'active' : '' ?>" href="<?php echo BASE_URL ?>?page=posts-featured&hm=1">Featured</a>
                        <a class="link_aside <?php echo $page == 'top-authors' ? 'active' : '' ?>" href="<?php echo BASE_URL ?>?page=top-authors">Authors</a>
                        <a class="link_aside <?php echo $page == 'contact-us' ? 'active' : '' ?>" href="<?php echo BASE_URL ?>?page=contact-us">Contact Us</a>
                    </ul>
                </aside>