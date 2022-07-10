<?php
session_start();
$post = $_POST['id_post'];
require_once "../database/db.php";
require_once "../config/consts.php";

$user = function ($id): array {
    $user = db::connecte()->prepare("select * from users where ID = :user");
    $user->bindParam(":user", $id);
    $user->execute();
    return $user->fetch(PDO::FETCH_ASSOC);
};

$userSession = null;
if (isset($_SESSION['user'])) {
    $userSession = $_SESSION['user'];
}


$stmt = db::connecte()->prepare("select * from  comments where id_post = :post  order by ID_comment desc");
$stmt->bindParam(":post", $post);
$output = "";

$stmt->execute();
$comments = $stmt->fetchAll();
function timeAgoPost($datetime, $full = false) {
    $now = new DateTime;
    $tosub = new DateInterval('PT1H');
    $ago = new DateTime($datetime, new DateTimeZone('UTC'));
    $ago->sub($tosub);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
foreach ($comments as $c) {
    $u = $user($c['id_user']);
    
    $output .= '
         <div class="list-group-item px-3 py-2 rounded border-0 bg-light mb-1 d-flex justify-content-between align-items-center">
         <div class="box_img">
             <img src="assets/images/users/' . $u['image'] . '" alt="user comment picture">
        
         </div>
         <div class="pl-3 text_box">
             <a target="_blank" href="'.BASE_URL .'?page=profile-of&user-id='. $u['ID'] .'">' . $u['first_name'] . " " . $u['last_name'] . '</a>
             <p class="text-break">' . $c['comment'] . '</p>
             <small>' . timeAgoPost($c['date_comment']) . '</small>
         </div>';
    if (isset($userSession->ID) && $userSession->ID === $c['id_user']) {
        $output .= '<form method="post">
            <input type="hidden" name="comment-id" value="' .  $c['ID_comment'] . '">
            <button type="submit" name="deleteComment"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></form></div>';
    } else {
        $output .= '</div>';
    }
}
echo $output;
