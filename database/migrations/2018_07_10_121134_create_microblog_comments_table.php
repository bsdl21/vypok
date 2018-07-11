<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicroblogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microblog_comments', function (Blueprint $table) {
            $table->increments('id');
			$table->string('author');
			$table->text('content');
			$table->integer("upvotes")->default(0);
			$table->text('upvoted_users')->default("");
			$table->integer("post_id")->references('id')->on('microblog_posts');
			$table->integer("reply_to");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('microblog_comments');
    }
}
