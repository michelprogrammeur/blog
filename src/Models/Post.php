<?php

namespace App\Models;

use App\Database\Connect;

class Post {

    // récupérer tout les posts
    public static function getAllPosts() {
        global $connect;

        $response = $connect->getPdo()->query('SELECT * FROM billets');
        $data = $response->fetchAll(\PDO::FETCH_OBJ);

        return $data;
    }

    // récupérer un post
    public static function getSinglePost($id) {
        global $connect;

        $response = $connect->getPdo()->prepare('SELECT * FROM billets WHERE id = :id');
        $response->execute([
            "id" => $id
        ]);
        $data = $response->fetch(\PDO::FETCH_OBJ);

        return $data;
    }

    // ajouter un nouveau post
    public static function AddNewPost() {
        global $connect;

        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);

        $response = $connect->getPdo()->prepare('
            INSERT INTO billets(title, content, published_at) 
            VALUES(:title, :content, now())
        ');
        $response->execute([
            "title" => $title,
            "content" => $content
        ]);
        $data = $response->fetch(\PDO::FETCH_OBJ);

        return $data;
    }

    // ajouter un nouveau post
    public static function editPost($id) {
        global $connect;

        $response = $connect->getPdo()->prepare('SELECT * FROM billets WHERE id = :id');
        $response->execute([
            "id" => $id
        ]);
        $data = $response->fetch(\PDO::FETCH_OBJ);

        return $data;
    }

    public static function updatePost($id) {
        global $connect;

        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);

        $response = $connect->getPdo()->prepare('
            UPDATE billets 
            SET title = :title, content = :content, published_at = current_timestamp 
            WHERE id = :id
        ');
        $response->execute([
            "title" => $title,
            "content" => $content,
            "id" => $id
        ]);
        $data = $response->fetch(\PDO::FETCH_OBJ);

        return $data;
    }

    public static function deletePost($id) {
        global $connect;

        $response = $connect->getPdo()->prepare('
            DELETE FROM billets WHERE id = :id
        ');
        $response->execute([
            "id" => $id
        ]);

        return;
    }

}