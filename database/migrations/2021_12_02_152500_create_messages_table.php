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
            $table->id();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->text('body');
            $table->timestamps();

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            
            $table->dropForeign('messages_apartment_id_foreign');
        });

        Schema::dropIfExists('messages');
    }
}
