<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_lists', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->comment('メッセージリストID');
            $table->unsignedBigInteger('owner_member_id')->nullable(false)->default(0)->comment('オーナーメンバーID');
            $table->text('name')->nullable(true)->comment('メッセージリスト名');
            $table->timestamps();
            $table->timestamp('removed_at')->nullable(true)->comment('削除日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_lists');
    }
}
