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
    public static function AddNewPost(array $data) {
        global $connect;

        $title = $data['title'];
        $abstract = $data['abstract'];
        $content = $data['content'];

        $response = $connect->getPdo()->prepare('
            INSERT INTO billets(title, abstract, content, published_at) 
            VALUES(:title, :abstract, :content, now())
        ');
        $response->execute([
            "title" => $title,
            "abstract" => $abstract,
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

    public static function updatePost($id, array $data) {
        global $connect;

        $title = $data['title'];
        $abstract = $data['abstract'];
        $content = $data['content'];

        $response = $connect->getPdo()->prepare('
            UPDATE billets 
            SET title = :title, abstract = :abstract, content = :content, published_at = current_timestamp 
            WHERE id = :id
        ');
        $response->execute([
            "title" => $title,
            "abstract" => $abstract,
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