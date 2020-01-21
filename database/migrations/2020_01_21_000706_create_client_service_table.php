<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_service', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Foreign Key client_id
            $table->unsignedBigInteger('client_id')->nullable();
            $table->index('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            // Foreign Key service_id
            $table->unsignedBigInteger('service_id')->nullable();
            $table->index('service_id');
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');

            $table->unique(['client_id', 'service_id']);

            $table->datetime('created_at')->default(\Carbon\Carbon::now());
            $table->datetime('updated_at')->default(\Carbon\Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_service');
    }
}
