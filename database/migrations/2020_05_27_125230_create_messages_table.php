<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->comment('メッセージID');
            $table->unsignedBigInteger('message_list_id')->nullable(false)->default(0)->comment('メッセージリストID');
            $table->unsignedBigInteger('member_id')->nullable(false)->comment('送信者');
            $table->text('message')->nullable(false)->comment('メッセージ');
            $table->string('ipv4')->comment('IPv4');
            $table->text('ipv6')->comment('IPv6');
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
        Schema::dropIfExists('messages');
    }
}
