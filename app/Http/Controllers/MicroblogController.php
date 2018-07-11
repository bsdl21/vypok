<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#use Auth;
use App\MicroblogPost;
use App\MicroblogComment;
use Illuminate\Support\Facades\Auth;

class MicroblogController extends Controller
{
    public function index()
	{
		return view('microblog/index');
	}

	public function load_post(Request $request, $id)
	{
		$post = MicroblogPost::findOrFail($id);
		if(!$post)
			return response()->json(["post" => "None"]);
		$comments = $post->comments;
		return response()->json($post);
	}

	public function show_post(Request $request, $id)
	{
		return view('microblog/post');
	}

	public function init(Request $request, $limit=5)
	{
		$posts = MicroblogPost::orderBy("created_at", "desc")
								->take($limit)
								->get();

		return response()->json($posts);
	}

	public function load_new(Request $request, $start_id)
	{
		$posts = MicroblogPost::where('id', '>', $start_id)
								->orderBy("created_at", "desc")
								->get();
		return response()->json($posts);
	}

	public function load_older(Request $request, $start_id, $limit=5)
	{
		$posts = MicroblogPost::where('id', '<', $start_id)
								->orderBy("created_at", "desc")
								->take($limit)
								->get();
		return response()->json($posts);
	}

	public function create_post(Request $request)
	{
		if(!$request->input('content') || !Auth::check())
			return response()->json(["error" => "An error has occurred."]);

		$user = $request->user();
		$post = MicroblogPost::create([
			"author" => $user->name,
			"content" => $request->input('content')
		]);

		return response()->json($post);
	}

	public function create_comment(Request $request, $post_id)
	{
		if(!$request->input('content') || !Auth::check())
			return response()->json(["error" => "An error has occurred."]);

		$post = MicroblogPost::find($post_id);
		if(!$post)
			return response()->json(["error" => "An error has occurred."]);

		if(!$request->input("reply_to"))
			$reply_to = 0;
		else
			$reply_to = $request->input("reply_to");

		$user = $request->user();
		$comment = MicroblogComment::create([
			"author" => $user->name,
			"content" => $request->input('content'),
			"post_id" => $post_id,
			"reply_to" => $reply_to
		]);

		return response()->json($comment);
	}
}
