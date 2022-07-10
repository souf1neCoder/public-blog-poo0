<?php
class ContactController{
    public function ContactUs($name,$email,$msg){
      
       $Subject = 'Message par un Visiteur Article0';
       
      
        $Body    = '<h1>Message Par ' . $name . '</h1><br>
        <a mailto="' . $email .'">'. $email .'</a>
        <p>'. $msg .'</p>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <'. $email .'>' . "\r\n";
        $headers .= 'Cc: '. $email  . "\r\n";
        $checkEmail = mail("mchanna.soufiane@gmail.com",$Subject,$Body,$headers);

            if ($checkEmail) {
                SetAlert::set("success","Message Sent");
                header("location:".BASE_URL."?page=contact-us");
                    
            }else{
                SetAlert::set("danger","Something wrong please try again!");
                header("location:".BASE_URL."?page=contact-us");
            }
    }
}