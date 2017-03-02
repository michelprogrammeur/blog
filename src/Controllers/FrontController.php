<?php

namespace App\Controllers;


use App\Helpers\Helpers;
use App\Models\Comment;
use App\Models\Post;

class FrontController
{
    use Helpers;

    public function index() {
        $posts = Post::getAllPosts();
        $this->renderView('index', compact('posts'));
    }

    public function showSinglePost($id) {
        $post = Post::getSinglePost($id);
        $comments = Comment::getAllCommentsByPost($id);

        $this->renderView('singlePost', compact('post', 'comments'));
    }
}