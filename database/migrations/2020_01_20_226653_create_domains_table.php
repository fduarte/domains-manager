<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('domain_name')->nullable();

            // createdDate
            $table->datetime('domain_created_date')->nullable();

            // expiresDate
            $table->datetime('domain_expires_date')->nullable();

            // status
            $table->string('domain_status')->nullable();

            // administrativeContactName
            $table->string('admin_contact_name')->nullable();

            // administrativeContactEmail
            $table->string('admin_contact_email')->nullable();

            // clientPaid
            $table->tinyInteger('client_paid')->default(0);

            // clientPaidDate
            $table->date('client_paid_date')->nullable();

            // Foreign Key client_id
            $table->unsignedBigInteger('client_id')->nullable();
            $table->index('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

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
        Schema::dropIfExists('domains');
    }
}
