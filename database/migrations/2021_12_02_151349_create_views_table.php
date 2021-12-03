<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->dateTime('visited_at');
            $table->char('ip_adress',16);
            $table->timestamps();

            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('views', function (Blueprint $table) {

            $table->dropForeign('views_apartment_id_foreign');

            $table->dropColumn('apartment_id');
        });


        Schema::dropIfExists('views');
    }
}
