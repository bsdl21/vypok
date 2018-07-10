<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
#https://github.com/lazychaser/laravel-nestedset
class MicroblogComment extends Model
{
    use NodeTrait;
	protected $table = 'microblog_comments';

	public function post()
	{
		return $this->belongsTo('App\MicroblogPost', 'id', 'post');
	}
}
