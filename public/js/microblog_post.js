const post_template = $('#post-template').html();
//Mustache.parse(post_template);   // optional, speeds up future uses

const comment_template = $('#comment-template').html();
//Mustache.parse(comment_template);

var stateReady = 1;
var stateBusy = 2;

var state = stateBusy;

var loadingTop = $(".loading-top"); // todo: fix the loading imgs

var pathArray = window.location.pathname.split( '/' );

var post_id = pathArray[3];
$.get( "/microblog/load/" + post_id, function( data ) {
	if(data.post == "None") {
		state = stateReady;
		$("#posts").html("There was an error");
		loadingTop.hide();
		return;
	}
	console.log(data);
	const rendered = Mustache.render(post_template, data);
	$("#posts").append(rendered);

	if(data.comments.length > 0) {
		jQuery.each(data.comments, function(i, comment) {
			const rendered_c = Mustache.render(comment_template, comment);
			$("#comments").append(rendered_c);
		});
	}

	$("#comment-form").css("display", "block");
	state = stateReady;
	loadingTop.hide();
});

$(document).ready(function(){
	$("#comment-form").submit(function( event ) { //// creating a post
	  const form = $(this).serialize();
	  event.preventDefault();
	  console.log(form);
	  $.ajax({
		 url: '/microblog/create_comment/'+post_id,
		 type: 'POST',
		 data: form,
		 success: function(response){
			response.upvotes = 0;
			const rendered = Mustache.render(comment_template, response);
			$("#comments").append(rendered);
			$("#comment-form textarea").val("");
		},
		error: function(request, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	  });
	});
});
