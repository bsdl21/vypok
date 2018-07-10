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
}
