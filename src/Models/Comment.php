<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 01/03/17
 * Time: 15:08
 */

namespace App\Models;


class Comment
{
    // Récupère tout les commentaires
    public static function getAllCommentsByPost($id) {
        global $connect;

        $req = $connect->getPdo()->prepare('SELECT * FROM comments WHERE post_id = :post_id And warning = 0');
        $req->execute([
            "post_id" => $id,
        ]);

        $comments = $req->fetchAll(\PDO::FETCH_OBJ);

        $comments_by_id = [];
        foreach ($comments as $comment) {
            $comments_by_id[$comment->id] = $comment;
        }
        return $comments_by_id;
    }


    public static function getAllWithReply($post_id, $unset_children = true)
    {
        $comments = $comments_by_id = self::getAllCommentsByPost($post_id);

        foreach ($comments as $id => $comment) {
            if ($comment->reply_id != 0) {
                $comments_by_id[$comment->reply_id]->children[] = $comment;

                if ($unset_children) {
                    unset($comments[$id]);
                }
            }
        }

        return $comments;
    }

    // Récupère les commentaires signalés
    public static function getAllCommentsReported() {
        global $connect;

        $response = $connect->getPdo()->query("SELECT * FROM comments WHERE warning = 1");
        $data = $response->fetchAll(\PDO::FETCH_OBJ);

        return $data;
    }

    // Ajouter un nouveau commentaire
    public static function addComment($userId, $postId, $author, $content) {
        global $connect;

        $empty = self::IfEmptyComment($content);

        if($empty) {
            $req = $connect->getPdo()->prepare('
                INSERT INTO comments(user_id, post_id, author, content, published_at) 
                VALUES(:user_id, :post_id, :author, :content, now())
            ');
            $req->execute([
                "user_id" => $userId,
                "post_id" => $postId,
                "author" => $author,
                "content" => $content,
            ]);

            $data = $req->fetch(\PDO::FETCH_OBJ);

            return $data;
        }
    }

    // Ajouter une réponss à un commentaire
    public static function addReply($userId, $postId, $replyId, $author, $content) {
        global $connect;

        $req = $connect->getPdo()->prepare("
            INSERT INTO comments(user_id, post_id, reply_id, author, content, published_at) 
            VALUES (:user_id, :post_id, :reply_id, :author, :content, NOW())
        ");
        $req->execute([
            "user_id" => $userId,
            "post_id" => $postId,
            "reply_id" => $replyId,
            "author" => $author,
            "content" => $content
        ]);
    }

    // Signale un commentaire
    public static function reportComment ($id) {
        global $connect;

        $response = $connect->getPdo()->prepare("UPDATE comments SET warning = 1 WHERE id = :id");
        $response->execute([
            "id" => $id,
        ]);
    }

    // Restaure un commentaire signalé
    public static function restoreComment($id) {
        global $connect;

        $response = $connect->getPdo()->prepare("UPDATE comments SET warning = 0 WHERE id = :id");
        $response->execute([
            "id" => $id,
        ]);
    }

    // Vérifie si le commentaire est vide
    public static function IfEmptyComment($field) {
        if (empty($field)) {

            return false;
        }else {

            return true;
        }
    }

    // Supprime un commentaire
    public static function deleteComment ($id) {
        global $connect;

        $response = $connect->getPdo()->prepare("DELETE FROM comments WHERE id = :id");
        $response->execute([
            "id" => $id,
        ]);
    }

}