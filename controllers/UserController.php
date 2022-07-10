<?php
class UserController
{

    // Register
    public function signUpController()
    {
        if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            SetAlert::set("danger", "Please Fill all fields");
            Redirect::to("sign-up");
        } else if (!preg_match("/^[a-zA-Z]*$/", $_POST['fname'])) {
            SetAlert::set("danger", "First name must contain only characters");
            Redirect::to("sign-up");
        } else if (!preg_match("/^[a-zA-Z]*$/", $_POST['lname'])) {
            SetAlert::set("danger", "Last name must contain only characters");
            Redirect::to("sign-up");
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username']) || strlen($_POST['username']) < 4) {
            SetAlert::set("danger", "Username must contain only characters & numbers & more than 4");
            Redirect::to("sign-up");
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            SetAlert::set("danger", "Email is not a valid email address");
            Redirect::to("sign-up");
        } else if (strlen($_POST['password']) < 6) {
            SetAlert::set("danger", "Password must contain 6 characters or more");
            Redirect::to("sign-up");
        } else {
            $password = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);

            $data = array(
                "first_name" => $_POST['fname'],
                "last_name" => $_POST['lname'],
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "password" => $password,

            );
            if (User::checkUserExistUsername($data) === 0) {

                if (User::checkUserExistEmail($data) === 0) {
                    if (User::signUp($data)) {
                       

                       
                        Redirect::to("sign-in");
                    } else {
                        SetAlert::set("danger", "Something wrong please try Again!");
                        Redirect::to("sign-up");
                    }
                } else {
                    SetAlert::set("danger", "Email is Already exist!");
                    Redirect::to("sign-up");
                }
            } else {
                SetAlert::set("danger", "Username is Already exist!");
                Redirect::to("sign-up");
            }
        }
    }
  
    //
    //  SingnIn
    //
    public function loginController()
    {
        if (empty($_POST['username/email']) || empty($_POST['password'])) {
            SetAlert::set("danger", "Please Fill all fields");
            Redirect::to("sign-in");
           
        }
        else{

            $data = array(
                "email" =>  $_POST['username/email'],
                "username" => $_POST['username/email'],
            );
    
            if (User::checkUserExist($data)) {
                $user = User::checkUserExist($data);
                $pass = $user->password;
                if (password_verify($_POST['password'], $pass)) {
                 
                        $_SESSION['logged'] = true;
                        $_SESSION['user'] = $user;
                        Redirect::to("home");
                  
                } else {
                    SetAlert::set("danger", "Password Invalid");
                    Redirect::to("sign-in");
                }
            } else {
                SetAlert::set("danger", "Username or Email not Exist");
                Redirect::to("sign-in");
            }
        } 
    }
    //
    // Edit
    public function editController()
    {
        if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['username']) || empty($_POST['email'])) {
            SetAlert::set("danger", "Please Fill all fields");
            Redirect::to("profile");
        } else if (!preg_match("/^[a-zA-Z]*$/", $_POST['fname'])) {
            SetAlert::set("danger", "First name must contain only characters");
            Redirect::to("profile");
        } else if (!preg_match("/^[a-zA-Z]*$/", $_POST['lname'])) {
            SetAlert::set("danger", "Last name must contain only characters");
            Redirect::to("profile");
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['username']) || strlen($_POST['username']) < 4) {
            SetAlert::set("danger", "Username must contain only characters & numbers & more than 4");
            Redirect::to("profile");
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            SetAlert::set("danger", "Email is not a valid email address");
            Redirect::to("profile");
        }  else {
            
         
            $data = array(
                "first_name" => $_POST['fname'],
                "last_name" => $_POST['lname'],
                "username" => $_POST['username'],
                "email" => $_POST['email'],
               
           
                "bio" => htmlentities($_POST['bio']),
                "image" => $_SESSION['user']->image,
                "id" => $_SESSION['user']->ID,
            );
            $emailCount = User::checkUserExistEmailId($data);
            $usernameCount = User::checkUserExistUsernameId($data);
            if ($usernameCount === 0) {
                if ($emailCount === 0) {
                    if (User::editProfile($data)) {
                        $userEdited = User::checkUserExist($data);
                        $_SESSION['user'] = $userEdited;
                       
                        

                            SetAlert::set("success", "Account edited Successfully!");
                            Redirect::to("profile");
                        
                    } else {
                        SetAlert::set("danger", "Something wrong please try Again!");
                        Redirect::to("profile");
                    }
                } else {
                    SetAlert::set("danger", "Email is Already exist!");
                    Redirect::to("profile");
                }
            } else {
                SetAlert::set("danger", "Username is Already exist!");
                Redirect::to("profile");
            }
        }
    }
    // 
    // 
    // Set image
    public function updateImageController($data)
    {
        $id = $_POST['id'];
        $nameCurrent = $_POST['nameCurrent'];
        $name = $data['name'];
        $tmp_name = $data['tmp_name'];
        $size = $data['size'];
        $target_dir = "assets/images/users/";
        $target_file = $target_dir . basename($name);
        $extImage = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $formats = ['jpg', 'png', 'jpeg'];
        if (!in_array($extImage, $formats)) {
            SetAlert::set("danger", "Sorry, only JPG, JPEG, PNG files are allowed.");
            Redirect::to("profile");
            exit();
        }
        if ($size > 1200000) {
            SetAlert::set("danger", "Image Size Is Too Large must be less Than 1.2mb");
            Redirect::to("profile");
            exit();
        }

        $newImageName = "profile" . "-" . date("Y.m.d") . "-" . date("h.i.sa");
        $newImageName .= "." . $extImage;
        $dataImage = array(
            "id" => $id,
            "image" => $newImageName
        );
        if (User::updateImage($dataImage)) {
            $updateUser = array(
                "username" => $_POST['username'],
                "email" => $_POST['email']
            );
            move_uploaded_file($tmp_name, $target_dir . $newImageName);
            $userImage = User::checkUserExist($updateUser);
            $_SESSION['user'] = $userImage;

            if ($nameCurrent !== "default_profile_img.png") {
                unlink($target_dir . $nameCurrent);
            }
            SetAlert::set("success", "Image Uploaded Successfully");
            Redirect::to("profile");
        } else {
            SetAlert::set("danger", "Sorry Something wrong please try Again");
            Redirect::to("profile");
            exit();
        }
    }
    // 
    // 
    // delete image
    public function deleteImageController()
    {
        $data = array(
            "id" => $_POST['id'],
            "image" => "default_profile_img.png",
            "username" => $_POST['username'],
            "email" => $_POST['email']
        );
        if (User::updateImage($data)) {
            $target_dir = "assets/images/users/";
            $nameCurrent = $_POST['nameCurrent'];
            $userImage = User::checkUserExist($data);
            $_SESSION['user'] = $userImage;
            unlink($target_dir . $nameCurrent);
            SetAlert::set("info", "Image Deleted Successfully");
            Redirect::to("profile");
        }
    }
    //
    //get all users
    public function getAllUsersController()
    {
        if (isset($_GET['user-id']) && !empty($_GET['user-id'])) {
            $id_user = filter_var($_GET['user-id'], FILTER_SANITIZE_NUMBER_INT);
            return User::getAllUsers($id_user);
        } else {
            return User::getAllUsers();
        }
    }
    //get Profile
    public function getProfileController($id_user)
    {

        return User::getProfile($id_user);
    }
    //
    //
    public function deleteUserController($id, $image)
    {
        $target_dir = "assets/images/users/";
        $target_dir_posts = "assets/images/posts/";
        unlink($target_dir . $image);
        $postsDeleted = Post::getAllPosts($id);
        foreach ($postsDeleted as $p) {
            unlink($target_dir_posts . $p['post_image']);
        }
        User::deleteUser($id);
        SetAlert::set("info", "User Deleted Successfully!");
        Redirect::to("users-s-blog");
    }
    //
    public function TopUsersContrlr($offset = null, $limit = null)
    {
        return User::TopUsers($offset, $limit);
    }
    //

    public function TopUsersPagesContrlr()
    {
        return User::TopUsersPages();
    }
    //

}
