<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('unique_id', 45)->nullable(false)->comment('ユニークID');
            $table->text('password')->nullable(false)->comment('パスワード');
            $table->timestamps();
            $table->timestamp('removed_at')->nullable(true)->comment('削除日時');
            $table->unique(['unique_id']);
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
