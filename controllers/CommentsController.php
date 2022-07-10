<?php
class CommentsController
{
    public function getAllCommentsController()
    {
        $comments = null;
        if (isset($_GET['user-id'])) {
            $comments = Comment::getCommentsByUser($_GET['user-id']);
        } else if (isset($_GET['post-id'])) {
            $comments = Comment::getCommentsByPost($_GET['post-id']);
        } else {
            $comments = Comment::getAllComments();
        }
        return $comments;
    }
  
    public function getAuthorOfCommentContrlr($id)
    {
        return Comment::getAuthorOfComment($id);
    }
    public function deleteCommentController($id,$red)
    {
        Comment::deleteComment($id);
        SetAlert::set("info", "Comment deleted Successfully");
        Redirect::to($red);
    }
   
}
