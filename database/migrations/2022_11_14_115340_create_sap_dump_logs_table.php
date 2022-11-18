<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapDumpLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sap_dump_logs', function (Blueprint $table) {
            $table->id();
            $table->string('assignment')->nullable();
            $table->string('document_number')->nullable();
            $table->string('document_type')->nullable();
            $table->string('posting_key')->nullable();
            $table->string('amount')->nullable();
            $table->string('reference')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('profit_center')->nullable();
            $table->string('sp_g_l_trans_type')->nullable();
            $table->string('g_l_account')->nullable();
            $table->string('posting_date')->nullable();
            $table->string('purchasing_document')->nullable();
            $table->string('material')->nullable();
            $table->string('sales_document')->nullable();
            $table->string('clearing_document')->nullable();
            $table->string('customer')->nullable();
            $table->string('dump_type')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sap_dump_logs');
    }
}
