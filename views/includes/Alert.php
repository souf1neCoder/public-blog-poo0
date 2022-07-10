<?php
    if(isset($_COOKIE['success'])){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_COOKIE['success'] .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if(isset($_COOKIE['danger'])){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        ' . $_COOKIE['danger'] .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if(isset($_COOKIE['info'])){
        echo '<div class="alert  alert-info alert-dismissible fade show" role="alert">
        ' . $_COOKIE['info'] .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
?>