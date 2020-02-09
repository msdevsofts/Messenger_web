<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('unique_id', 45)->nullable(false)->comment('ユニークID');
            $table->text('password')->nullable(false)->comment('パスワード');
            $table->string('nickname', 256)->nullable(false)->comment('名前');
            $table->unsignedTinyInteger('sex')->nullable(false)->comment('性別');
            $table->timestamps();
            $table->timestamp('removed_at')->nullable(true)->comment('削除日時');
            $table->unique(['unique_id']);
            $table->index(['id', 'created_at']);
            $table->index(['sex']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
