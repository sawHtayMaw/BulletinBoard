<?php

namespace App\Contracts\Dao\Post;

use App\Models\Post;

interface PostDaoInterface
{
    /**
     * get post list
     * @return postlist
     */
    public function getPostList();
    /**
     * get a specific post
     * @param int $id
     * @return Post
     */
    public function getPostById($id);
    /**
     * get post by title
     * @param string $title
     * @return Post
     */
    public function getPostByTitle($title);
    /**
     * get post by search keyword
     * @param int $q
     * @return postList
     */
    public function postSearch($q);
    /**
     * create post
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function savePost($post);
    /**
     * edit post
     * @param \Illuminate\Http\$request
     * @return \Illuminat\Http\Responser
     */
    public function updatePost($request, $id);
    /**
     * delete post
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function deletePost($post);

}
