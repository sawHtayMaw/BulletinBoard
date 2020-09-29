<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Imports\PostImport;
use App\Models\Post;
use App\Util\StringUtil;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    protected $postInterface;
    /**
     * @param PostServiceInterface $postInterface
     * @return void
     */
    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }/**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postList = $this->postInterface->getPostList();
        $message = $this->postInterface->getAvailableMessage($postList);
        return view('post.postlist')->with('postList', $postList)->with('message', $message);
    }
    /**
     * Display a listing of the search resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $postList = $this->postInterface->getSearchPost($query);
        if (StringUtil::isNotEmpty($query)) {
            $message = $this->postInterface->getAvailableMessage($postList);
            return view('post.postlist')->with('postList', $postList)->with('message', $message);
        } else {
            return redirect('/');
        }
    }
    /**
     * create post
     * @return \Illuminat\Http\Response
     */
    public function createPost()
    {
        return view('post.addpost');
    }
    /**
     * confirm create post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCreate(PostRequest $request)
    {
        $post['title'] = $request->title;
        $post['description'] = $request->description;
        return view('post.confirmcreate')->with('post', $post);
    }
    /**
     * created post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicate = $this->postInterface->isDuplicateTitle($request);
        $post = $this->postInterface->getPostByTitle($request->title);
        if ($duplicate) {
            return view('post.addpost')->with('duplicate', $duplicate)->with('post', $post);
        }
        $this->postInterface->savePost($request);
        return redirect()->route('posts#index');
    }
    /**
     * edit post
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost($id)
    {
        $post = $this->postInterface->getPostById($id);
        return view('post.editpost')->with('post', $post);
    }
    /**
     * confirm edit post
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmUpdate(PostRequest $request, $id)
    {
        $post['id'] = $id;
        $post['title'] = $request->title;
        $post['description'] = $request->description;
        $status = $request->has('status') ? "1" : "0";
        $post['status'] = $status;
        return view('post.confirmedit')->with('post', $post);
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, $id)
    {
        $this->postInterface->updatePost($request, $id);
        return redirect()->route('posts#index');
    }
    /**
     * delete post
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deletePost($id)
    {
        $this->postInterface->deletePost($id);
        return redirect()->route('posts#index');
    }
    /**
     * Display upload form of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpload()
    {
        return view('post.uploadcsv');
    }
    /**
     * Upload function for uploading CSV File and import into Database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadPost(Request $request)
    {
        $validatedData = $request->validate([
            'csvfile' => 'required|max:2048',
        ]);
        try {
            Excel::import(new PostImport, $request->file('csvfile'));
            Storage::delete('framework/laravel-excel');
        } catch (QueryException $exception) {
            return redirect()->back()->with('message', 'Upload Failed, Try Again!');
        }
        return redirect()->route('posts#index');
    }
    /**
     * download posts
     */
    public function download()
    {
        return $this->postInterface->downloadPost();
    }
}
