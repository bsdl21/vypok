const post_template = $('#post-template').html();
Mustache.parse(post_template);   // optional, speeds up future uses

var load_posts_count = 10;
var last_post_id;

var oldest_post;


var stateReady = 1;
var stateBusy = 2;

var state = stateReady;

$.get( "/microblog/init/" + load_posts_count, function( data ) {
	if(data.length < 1)
		return;
	last_post_id = data[0].id;
	oldest_post = data[data.length-1].id
	console.log(oldest_post);
	jQuery.each(data, function(i, post) {
		const rendered = Mustache.render(post_template, post);
		$("#posts").append(rendered);
	});
});

function load_older(start_id) {
		$.get( "/microblog/load_older/" + start_id, function( data ) {
			if(data.length < 1)
				return;
			oldest_post = data[data.length-1]["id"];
			jQuery.each(data, function(i, post) {
				const rendered = Mustache.render(post_template, post);
				$("#posts").append(rendered);
				console.log("Loaded post #" + post.id);
			});
		});
}

function load_new(start_id)
{
	$.get("/microblog/load_new/"+ start_id, function (data){
		if(data.length < 1)
			return;
		jQuery.each(data, function(i, post) {
			const rendered = Mustache.render(post_template, post);
			$("#posts").prepend(rendered);
			last_post_id = post.id;
		});
	});
}




//////////////////////////////


$(document).ready(function(){
	setTimeout(
		function(){
			state = stateBusy;
			console.log(oldest_post);
			load_older(oldest_post);
			state=stateReady;
		}, 1000);
	$("#post-form").submit(function( event ) {
		const form = $(this).serialize();
	  event.preventDefault();
	  $.ajax({
		 url: '/microblog/create',
		 type: 'POST',
		 data: form,
		 success: function(response){
			const rendered = Mustache.render(post_template, response);
			$("#posts").prepend(rendered);
			$("#post-form textarea").val("");
		},
		error: function(request, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	  });
	});



	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() - 300 && state==stateReady)
		{
			state = stateBusy;
			load_older(oldest_post);
			setTimeout(function(){
				state=stateReady;
			}, 500);
		}
	})

});
