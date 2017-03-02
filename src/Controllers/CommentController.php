<?php

namespace App\Controllers;


use App\Helpers\Helpers;
use App\Models\Comment;

class CommentController
{
    use Helpers;

    public function add($post_id) {
        if (!empty($_POST)) {
            $content = htmlspecialchars($_POST['message']);
            $author = $_SESSION['user']['pseudo'];
            $user_id = $_SESSION['user']['id'];
            Comment::addComment($user_id, $post_id, $author, $content);

            $this->redirect('/post/' . $post_id);
        }
    }

    public function report($post_id, $id) {
        if (isset($_SESSION['user'])) {
            Comment::reportComment($id);

            $this->redirect("/post/" . $post_id);
        }
        else {
            $this->redirect("/");
        }
    }

    public function restore($id) {
        Comment::restoreComment($id);

        $this->redirect("/admin/comments");
    }
    
    public function CommentsReported() {
        $comments = Comment::getAllCommentsReported();
        $this->renderView("comments.index", compact('comments'));
    }

    public function delete($id) {
        Comment::deleteComment($id);

        $this->redirect("/admin/comments");
    }
}