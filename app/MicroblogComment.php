<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class MicroblogComment extends Model
{
	protected $table = 'microblog_comments';

	public function post()
	{
		return $this->belongsTo(MicroblogPost::class);
	}

	protected $fillable = [
		"author", "content", "post_id", "reply_to"
	];

}
