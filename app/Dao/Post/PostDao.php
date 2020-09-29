<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     *
     * @return postList
     */
    public function getPostList()
    {
        if (Auth::check()) {
            $post = (Auth::user()->isAdmin())? Post::query(): Post::where('create_user_id', Auth::user()->id);
        }
        else $post = Post::where('status', '1');
        $postList = $post->where('deleted_user_id', null)->paginate(5);
        return $postList;
    }
    /**
     * get post by search keyword
     * @param int $query
     * @return postList
     */
    public function postSearch($query)
    {
        $postList = Post::where('title', 'LIKE', '%' . $query . '%')->orWhere('description', 'LIKE', '%' . $query . '%')->where('deleted_user_id', null)->get();
        return $postList;
    }
    /**
     * get a specific post
     * @param int $id
     * @return post
     */
    public function getPostById($id)
    {
        return Post::find($id);
    }
    /**
     * get post by title
     * @param string $title
     * @return Post
     */
    public function getPostByTitle($title)
    {
        return Post::where('title', $title)->first();
    }
    /**
     * create post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function savePost($request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->create_user_id = Auth::id();
        $post->updated_user_id = Auth::id();
        $post->save();
    }
    /**
     * edit post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = ($request->has('status')) ? "1" : "0";
        $post->updated_user_id = Auth::user()->id;
        $post->save();
    }
    /**
     * delete post
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deletePost($id)
    {
        Post::where('id', $id)->delete();
    }
}
