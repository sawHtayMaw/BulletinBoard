<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;
use App\Util\StringUtil;
use App\Exports\PostExport;
use Maatwebsite\Excel\Facades\Excel;


class PostService implements PostServiceInterface
{
    private $postDao;
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }
    /**
     * get post list
     * @return postList
     */
    public function getPostList()
    {
        return $this->postDao->getPostList();
    }
    /**
     * get a specific post
     * @param int $id
     * @return post
     */
    public function getPostById($id)
    {
        return $this->postDao->getPostById($id);
    }
    /**
     * get post by title
     * @param string $title
     * @return Post
     */
    public function getPostByTitle($title)
    {
        return $this->postDao->getPostByTitle($title);
    }
    /**
     * get post by search keyword
     * @param int $q
     * @return postList
     */
    public function getSearchPost($q)
    {
        return $this->postDao->postSearch($q);
    }
    /**
     * Check Method Title of Post Duplicated or Not
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function isDuplicateTitle($request)
    {
        if (StringUtil::isNotEmpty($this->postDao->getPostByTitle($request->input('title')))) {
            return true;
        }
        else false;
    }
    /**
     * create post
     * @param Post $post
     * @return \Illuminate\Http\$request
     */
    public function savePost($request)
    {
        $this->postDao->savePost($request);
    }
    /**
     * edit post
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id)
    {
        $this->postDao->updatePost($request, $id);
    }
    /**
     * delete post
     * @param Post $post
     * @return \Illuminate\Http\$request
     */
    public function deletePost($post)
    {
        return $this->postDao->deletePost($post);
    }
    /**
     * download posts
     */
    public function downloadPost()
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }
}
