<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\User;

class MicroblogPost extends Model
{
    protected $table = 'microblog_posts';
	protected $fillable = [
		"author", "content"
	];
	public function comments()
	{
		return $this->hasMany('App\MicroblogComment');
	}
	public function get_post($id)
	{
		return App\MicroblogPost::findOrFail($id);
	}
}
