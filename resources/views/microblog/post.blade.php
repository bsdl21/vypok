@extends('base')

@section('title', 'Microblog')

@section('head')

	<link rel="stylesheet" href="{{ asset('css/microblog.css') }}" / />
@endsection

@section('content')
	@include('layouts.microblog_post')
	@include('layouts.microblog_comment')
	<h2>
		Microblog
	</h2>


	<div class="loading">
		<img src="{{ asset('img/loading.gif') }}" alt="Loading..." class="loading loading-top" />
	</div>
	<div id="posts">
	</div>
	<div id="comments">
	</div>
	@if (Auth::check())
		<form id="comment-form" method="post">
			@csrf
			<textarea name="content"></textarea><br / />
			<input id="create-comment" type="submit" />
		</form>
	@endif
@endsection

@section('footer')
	<script src="{{ asset('js/mustache.js') }}"></script>
	<script src="{{ asset('js/microblog_post.js') }}"></script>
@endsection
