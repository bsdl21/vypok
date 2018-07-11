
@if (Auth::check())
	<script id="comment-template" type="x-tmpl-mustache">
		@verbatim
			<!-- comment template if user is logged in -->
			<div class="comment" id="comment-{{id}}">
				<header class="comment-header">
					<span class="id"># {{id}}</span>
					<span class="author">{{ author }}</span>
					<span class="datetime">{{ created_at }}</span>
					<span class="upvotes">+{{ upvotes }}</span>
				</header>
				<section class="comment-content">
					{{ content }}
				</section>
				<footer>
					Reply
				</footer>
			</div>
		@endverbatim
	</script>
@else
	<script id="comment-template" type="x-tmpl-mustache">
		@verbatim
		<!-- comment template if user is not logged in -->
		<div class="comment" id="comment-{{id}}">
			<header class="comment-header">
				<span class="id"># {{id}}</span>
				<span class="author">{{ author }}</span>
				<span class="datetime">{{ created_at }}</span>
				<span class="upvotes">+{{ upvotes }}</span>
			</header>
			<section class="comment-content">
				{{ content }}
			</section>
		</div>
		@endverbatim
	</script>
@endif
