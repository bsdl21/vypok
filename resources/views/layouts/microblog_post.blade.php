@if (Auth::check())
	<script id="post-template" type="x-tmpl-mustache">
		@verbatim
			<!-- post template if user is logged in -->
			<div class="post" id="post-{{ id }}">
				<header class="post-header">
					<span class="id"># {{id}}</span>
					<span class="author">{{ author }}</span>
					<span class="datetime">
						<a href="/microblog/show/{{id}}">
							{{ created_at }}
						</a>
					</span>
					<span class="upvotes">+{{ upvotes }}</span>
				</header>
				<section class="post-content">
					{{ content }}
				</section>
				<footer>
					Reply
				</footer>
			</div>
		@endverbatim
	</script>

@else
	<script id="post-template" type="x-tmpl-mustache">
		@verbatim
			<!-- post template if user is not logged in -->
			<div class="post" id="post-{{ id }}">
				<header class="post-header">
					<span class="id"># {{id}}</span>
					<span class="author">{{ author }}</span>
					<span class="datetime">
						<a href="/microblog/show/{{id}}">
							{{ created_at }}
						</a>
					</span>
					<span class="upvotes">+{{ upvotes }}</span>
				</header>
				<section class="post-content">
					{{ content }}
				</section>
			</div>
		@endverbatim
	</script>

@endif
