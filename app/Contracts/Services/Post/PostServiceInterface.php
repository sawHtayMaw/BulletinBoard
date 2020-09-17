<?php

namespace App\Contracts\Services\Post;

use App\Models\Post;
use GuzzleHttp\Psr7\Request;

interface PostServiceInterface
{
    /**
     * get post list
     * @return postList
     */
    public function getPostList();
    /**
     * get a specific post
     * @param int $id
     * @return post
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
    public function getSearchPost($q);
    /**
     * Check Method Title of Post Duplicated or Not
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function isDuplicateTitle($request);
    /**
     * create post
     * @param Post $post
     * @return \Illuminate\Http\$request
     */
    public function savePost($request);
    /**
     * edit post
     * @param \Illuminate\Http\$request
     * @return \Illuminat\Http\Responser
     */
    public function updatePost($request, $id);
    /**
     * delete post
     * @param Post $post
     * @return \Illuminate\Http\$request
     */
    public function deletePost($post);
    /**
     * download posts
     */
    public function downloadPost();
}
