<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_members', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->nullable(false)->comment('メッセージリストID');
            $table->unsignedBigInteger('member_id')->nullable(false)->comment('メンバーID');
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
        Schema::dropIfExists('message_members');
    }
}
