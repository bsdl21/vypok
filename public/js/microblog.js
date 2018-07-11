const post_template = $('#post-template').html();
Mustache.parse(post_template);   // optional, speeds up future uses

var load_posts_count = 15;
var last_post_id;

var oldest_post;


var stateReady = 1;
var stateBusy = 2;

var state = stateBusy;

var loadingTop = $(".loading-top"); // todo: fix the loading imgs
var loadingBottom = $(".loading-bottom");

$.get( "/microblog/init/" + load_posts_count, function( data ) {
	if(data.length < 1) {
		$("#posts").html("<span class='no_posts_error'>There is no posts.</span>");
		loadingTop.hide();
		state = stateReady;
		return;
	}
	last_post_id = data[0].id;
	oldest_post = data[data.length-1].id
	jQuery.each(data, function(i, post) {
		const rendered = Mustache.render(post_template, post);
		$("#posts").append(rendered);
		state = stateReady;
		loadingTop.hide();
	});
});


function load_older(start_id) {
		loadingBottom.css("display", "block");
		$.get( "/microblog/load_older/" + start_id, function( data ) {
			if(data.length < 1)
				return;
			oldest_post = data[data.length-1]["id"];
			jQuery.each(data, function(i, post) {
				const rendered = Mustache.render(post_template, post);
				$("#posts").append(rendered);
				//console.log("Loaded post #" + post.id);
			});
		});
		loadingBottom.hide();
}

function load_new(start_id)
{
	loadingTop.show();
	$.get("/microblog/load_new/"+ start_id, function (data){
		if(data.length < 1)
			return;
		last_post_id = data[0].id;
		jQuery.each(data, function(i, post) {
			const rendered = Mustache.render(post_template, post);
			$("#posts").prepend(rendered);
		});
	});
	loadingTop.hide();
}




//////////////////////////////


$(document).ready(function(){

	$("#post-form").submit(function( event ) { //// creating a post
	  const form = $(this).serialize();
	  event.preventDefault();

	  $.ajax({
		 url: '/microblog/create',
		 type: 'POST',
		 data: form,
		 success: function(response){
			response.upvotes = 0;
			const rendered = Mustache.render(post_template, response);
			$("#posts").prepend(rendered);
			$("#post-form textarea").val("");
			$(".no_posts_error").hide();
		},
		error: function(request, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	  });
	});



	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() - 400 && state==stateReady)
		{
			state = stateBusy;
			load_older(oldest_post);
			setTimeout(function(){
				state=stateReady;
			}, 500);
		}
	})

});
