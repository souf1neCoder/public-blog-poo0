<?php 
 session_unset();
 session_destroy();
 Redirect::to("sign-in");
 exit;