<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->text("client_name");
            $table->string("client_code")->nullable();
            $table->string("email")->nullable();
            $table->string("contact")->nullable();
            $table->string("mobile")->nullable();
            $table->foreignId("account_type_id")->constrained();
            $table->foreignId("profit_center_id")->constrained();
            $table->foreignId("business_unit_id")->constrained();
            $table->foreignId("category_id")->constrained();
            $table->foreignId("business_segment_id")->constrained();
            $table->foreignId("service_id")->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['0', '1','2','3'])->comment('0 > active, 1 > deactive,2 > deleted,3 > archived');
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
        Schema::dropIfExists('clients');
    }
}
