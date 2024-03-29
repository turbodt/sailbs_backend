<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tokens');
        Schema::create('tokens', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('type',32)->nullable(false);
            $table->string('value',128)->nullable(false);
            $table->integer('user_id')->unsigned()->nullable(true);
            $table->integer('api_id')->unsigned()->nullable(true);
            $table->dateTime('expire_at')->nullable(false);

            $table->boolean('deleted')->default(false);
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->dateTime('updated_at')->default(DB::raw('NOW()'));
            $table->dateTime('deleted_at')->nullable(true);

            $table->index('type');
            $table->unique('value');
            $table->index('user_id');
            $table->index('api_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokens', function (Blueprint $table) {
            //
        });
        Schema::dropIfExists('tokens');
    }
}
