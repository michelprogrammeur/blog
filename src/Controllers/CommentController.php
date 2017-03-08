<?php

namespace App\Controllers;


use App\Helpers\Helpers;
use App\Models\Comment;

class CommentController
{
    use Helpers;

    public function add($post_id, $data) {
        if (!empty($_POST)) {

            $content = htmlspecialchars($data['message']);
            $author = $_SESSION['user']['pseudo'];
            $user_id = $_SESSION['user']['id'];

            if (!isset($data['reply_id'])) {
                Comment::addComment($user_id, $post_id, $author, $content);
                $this->redirect('/post/' . $post_id)->with("comment_add", "Le commentaire à bien été ajouté");

                return;
            }
            else {
                $reply_id = $data['reply_id'];
                Comment::addReply($user_id, $post_id, $reply_id, $author, $content);
                $this->redirect("/post/" . $post_id)->with("comment_add_reply", "La réponse au commentaire a été ajoutée");

                return;
            }
        }
    }

    public function report($post_id, $id) {
        if (isset($_SESSION['user'])) {
            Comment::reportComment($id);

            $this->redirect("/post/" . $post_id)->with("comment_report", "Le commentaire a bien été signalé");
        }
        else {
            $this->redirect("/");
        }
    }

    public function restore($id) {
        Comment::restoreComment($id);

        $this->redirect("/admin/comments")->with("comment_restore", "Le commentaire a été restauré");
    }
    
    public function CommentsReported() {
        $comments = Comment::getAllCommentsReported();
        $this->renderView("comments.index", compact('comments'));
    }

    public function delete($id) {
        Comment::deleteComment($id);

        $this->redirect("/admin/comments")->with("comment_delete", "Le commentaire a bien été supprimé");
    }
}