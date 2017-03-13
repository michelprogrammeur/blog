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
use GUMP;

class PostController
{
    use Helpers;
    private $valid_errors;

    public function index() {
        $posts = Post::getAllPosts();
        $this->renderView('posts.index', compact('posts'));
    }

    public function create() {
        $this->renderView('posts.crud.create');
    }

    public function store() {

        $is_validate = GUMP::is_valid($_POST, array(
            "title" => "required|min_len,2|max_len,100",
            "content" => "required|min_len,2"
        ));

        if($is_validate === true) {
            $data_post = array(
                "title" => htmlentities($_POST['title']),
                "content" => htmlentities($_POST['content'])
            );

            Post::addNewPost($data_post);

            $this->redirect('/admin/posts')->with("post_add", "L'épisode à bien été ajouté");
        }else {

            $this->redirect("/admin/post/create")->with("post_add_error", "Les données ne correspondent pas aux contraintes demandées");
        }


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

        // TODO afficher les erreurs des validation GUMP

        $is_validate = GUMP::is_valid($_POST, array(
            "title" => "required|min_len,2|max_len,100",
            "content" => "required|min_len,2"
        ));

        if ($is_validate === true) {
            $data_post = [
                "title" => htmlspecialchars($_POST['title']),
                "content" => htmlspecialchars($_POST['content']),
            ];

            Post::updatePost($id, $data_post);

            $this->redirect('/admin/posts')->with("post_update", "L'épisode à bien été modifié");
        } else {

            $this->redirect("/admin/post/" . $id . "/edit")->with("post_update_error", "Les données ne correspondent pas aux contraintes demandées");
        }

    }

    public function destroy($id) {
        Post::deletePost($id);

        $this->redirect('/admin/posts')->with("post_delete", "L'épisode à été supprimé");
    }


}