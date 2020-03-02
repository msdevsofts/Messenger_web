<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->nullable(false)->comment('メンバーID');
            $table->unsignedBigInteger('target_id')->nullable(false)->comment('対象メンバーID');
            $table->dateTime('requested_at')->nullable(false)->comment('リクエスト日時');
            $table->dateTime('accepted_at')->nullable(true)->comment('許可日時');
            $table->dateTime('refused_at')->nullable(true)->comment('拒否日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_requests');
    }
}
