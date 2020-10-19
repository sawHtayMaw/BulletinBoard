<?php

namespace App\Contracts\Services\Post;

use App\Models\Post;

interface PostServiceInterface
{
    /**
     * get post list
     * @return postList
     */
    public function getPostList();
    /**
     * Get Post available or not Message
     *
     * @param List<Post> $postList
     * @return message
     */
    public function getAvailableMessage($postList);
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
     * @param int $query
     * @return postList
     */
    public function getSearchPost($query);
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
     * @return \Illuminate\Http\Request $request
     */
    public function savePost($request);
    /**
     * edit post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminat\Http\Responser
     */
    public function updatePost($request);
    /**
     * delete post
     * @param int $id
     * @return \Illuminate\Http\Request $request
     */
    public function deletePost($id);
    /**
     * download posts
     */
    public function downloadPost();
}
