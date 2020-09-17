<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Util\StringUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\PostImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postList = $this->postInterface->getPostList();
        return view('post.postlist')->with('postList', $postList);
    }
    /**
     * Display a listing of the search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = $request->input('q');
        $postList = $this->postInterface->getSearchPost($q);
        if (StringUtil::isNotEmpty($q)) {
            return view('post.postlist')->with('postList', $postList);
        } else {
            return redirect('/');
        }
    }
    /**
     * create post
     * @return \Illuminat\Http\Response
     */
    public function create()
    {
        return view('post.addpost');
    }
    /**
     * confirm create post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']]);
        if ($validator->fails()) {
            return redirect()->route('posts#create')->withErrors($validator)->withInput();
        } else {
            $post['title'] = $request->title;
            $post['description'] = $request->description;
            return view('post.confirmcreate')->with('post', $post);
        }
    }
    /**
     * created post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']]);
        if ($validator->fails()) {
            return redirect()->route('posts#create')->withErrors($validator)->withInput();
        }
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
     * @param \Illuminate\Http\$request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $post = $this->postInterface->getPostById($id);
        return view('post.editpost')->with('post', $post);
    }
    /**
     * confirm edit post
     * @param \Illuminate\Http\$request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $post['id'] = $id;
        $post['title'] = $request->title;
        $post['description'] = $request->description;
        $status = $request->has('status')? "1": "0";
        $post['status'] = $status;
        return view('post.confirmedit')->with('post', $post);
    }
    /**
     * @param \Illuminate\Http\$request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $this->postInterface->updatePost($request, $id);
        return redirect()->route('posts#index');
    }
    /**
     * delete post
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function delete($post)
    {
        $this->postInterface->deletePost($post);
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
    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'csvfile' => 'required|max:2048',
        ]);
        try {
            Excel::import(new PostImport, $request->file('csvfile'));
        }
        catch (QueryException $exception) {
            return redirect()->back()->with('message', 'Upload Failed, Try Again!');
        }
        return redirect() -> route('posts#index');
    }
    /**
     * download posts
     */
    public function download()
    {
        return $this->postInterface->downloadPost();
    }
}
