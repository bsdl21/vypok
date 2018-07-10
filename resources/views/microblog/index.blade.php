@extends('base')

@section('title', 'Microblog')

@section('head')
	<style>
		#posts {
			margin:0 auto;
			width:700px;
			max-width:100%;
			padding:10px;
		}
		.post {

			margin-top:15px;
		}
	</style>
	<script id="post-template" type="x-tmpl-mustache">
		@verbatim
			<div class="post" id="post-{{ id }}">
				<header class="post-header">
					<span class="id"># {{id}}</span>
					<span class="author">{{ author }}</span>
					<span class="datetime">{{ created_at }}</span>
					<span class="upvotes" style="float:right;">+{{ upvotes }}</span>
				</header>
				<section class="post-content">
					{{ content }}
				</section>
			</div>
		@endverbatim
	</script>
	<script src="{{ asset('js/mustache.js') }}"></script>
	<script src="{{ asset('js/microblog.js') }}"></script>
@endsection

@section('content')
	<h2>
		Microblog
	</h2>
	@if (Auth::check())
		<form id="post-form" action="{{ route('microblog_create_post') }}" method="post">
			@csrf
			<textarea name="content"></textarea>
			<input id="create-post" type="submit" />
		</form>
	@endif
	<div id="posts">
	</div>
@endsection
