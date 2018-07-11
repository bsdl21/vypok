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

	@if (Auth::check())
		<form id="post-form" action="{{ route('microblog_create_post') }}" method="post">
			@csrf
			<textarea name="content"></textarea><br / />
			<input id="create-post" type="submit" />
		</form>
	@endif
	<div class="loading">
		<img src="{{ asset('img/loading.gif') }}" alt="Loading..." class="loading loading-top" />
	</div>
	<div id="posts">
	</div>
	<div class="loading">
		<img src="{{ asset('img/loading.gif') }}" alt="Loading..." class="loading loading-bottom" />
	</div>
@endsection

@section('footer')
	<script src="{{ asset('js/mustache.js') }}"></script>
	<script src="{{ asset('js/microblog.js') }}"></script>
@endsection
