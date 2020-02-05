<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatesToDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {

            // Remove unecessary cols
            $table->dropColumn(['client_paid']);
            $table->dropColumn(['client_paid_date']);

            // domain_expires_date should be just date
            $table->date('domain_expires_date')->nullable()->change();

            // domain_name should be unique
            $table->unique('domain_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {

        });
    }
}
