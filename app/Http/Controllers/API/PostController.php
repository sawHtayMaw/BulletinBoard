<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }
    /**
     * get postlist
     */
    public function index()
    {
        $posts = $this->postInterface->getPostList();
        return response()->json($posts);
    }
    /**
     * Display a listing of the search resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        $postList = $this->postInterface->getSearchPost($search);
        return response()->json($postList);
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
            return response()->json(['message' => "Title is already exist"]);
        }
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->create_user_id = auth()->user()->id;
        $post->updated_user_id = auth()->user()->id;
        $post->save();
    }
    /**
     * get post by id
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $post = $this->postInterface->getPostById($id);
        return response()->json($post);
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->updated_user_id = Auth::user()->id;
        $post->save();
    }
    /**
     * Upload function for uploading CSV File and import into Database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $exploded = explode(',', $request->uploadData);
        $decoded = base64_decode($exploded[1]);
        $lines = explode("\n", $decoded);
        $arrays = array_map('str_getcsv', $lines);
        foreach ($arrays as $row) {
            Post::create([
                'title' => $row[0],
                'description' => $row[1],
                'status' => $row[2],
                'create_user_id' => Auth::user()->id,
                'updated_user_id' => Auth::user()->id,
            ]);
        }
    }
    /**
     * download posts
     */
    public function download()
    {
        return $this->postInterface->downloadPost();
    }
    /**
     * delete post
     * @param int $id
     */
    public function delete($id)
    {
        $post = Post::find($id);
        $post->deleted_user_id = Auth::user()->id;
        $post->save();
        $post->delete();
    }
}
