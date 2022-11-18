<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->string('department')->nullable();
            $table->foreignId("designation_id")->constrained();
            $table->integer('role_id')->unique();
            $table->foreignId("business_unit_id")->constrained();
            $table->foreignId("account_type_id")->constrained();
            $table->foreignId("category_id")->constrained();
            $table->enum('status', ['0', '1','2','3'])->comment('0 > active, 1 > deactive,2 > deleted,3 > archived');
            $table->string('password')->nullable();
            $table->string('import_type')->nullable();
            $table->timestamp('last_login')->nullable();
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
        Schema::dropIfExists('users');
    }
}
