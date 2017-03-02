<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 27/02/17
 * Time: 14:33
 */

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Helpers\Helpers;
use App\Validator;

class PostController
{
    use Helpers;

    public function index() {
        $posts = Post::getAllPosts();
        $this->renderView('posts.index', compact('posts'));
    }

    public function create() {
        $this->renderView('posts.crud.create');
    }

    public function store() {
        Post::addNewPost();
        $this->redirect('/admin/posts');
    }

    public function show($id) {
        $post = Post::getSinglePost($id);
        $this->renderView('posts.show', compact('post'));
    }

    public function edit($id) {
        $post = Post::editPost($id);
        $this->renderView('posts.crud.edit', compact('post'));
    }

    public function update($id) {
        Post::updatePost($id);
        $this->redirect('/admin/posts');
    }

    public function destroy($id) {
        Post::deletePost($id);
        $this->redirect('/admin/posts');
    }


}