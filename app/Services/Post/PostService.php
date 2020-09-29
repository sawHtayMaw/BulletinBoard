<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostExport;
use App\Models\Post;
use App\Util\StringUtil;
use Maatwebsite\Excel\Facades\Excel;

class PostService implements PostServiceInterface
{
    private $postDao;

    /**
     * Class Constructor
     * @param OperatorPostDaoInterface $postDao
     * @return
     */
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
     * @param int $query
     * @return postList
     */
    public function getSearchPost($query)
    {
        return $this->postDao->postSearch($query);
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
        } else {
            false;
        }
    }
    /**
     * Get Post available or not Message
     *
     * @param List<Post> postList
     * @return message
     */
    public function getAvailableMessage($postList)
    {
        $message = "";
        if (count($postList) <= 0)
            $message = 'No post available!';
        return $message;
    }

    /**
     * create post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function savePost($request)
    {
        $this->postDao->savePost($request);
    }
    /**
     * edit post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id)
    {
        $this->postDao->updatePost($request, $id);
    }
    /**
     * delete post
     * @param int $id
     * @return \Illuminate\Http\Request $request
     */
    public function deletePost($id)
    {
        return $this->postDao->deletePost($id);
    }
    /**
     * download posts
     */
    public function downloadPost()
    {
        return Excel::download(new PostExport, 'posts.csv');
    }
}
