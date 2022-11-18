<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreezesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freezes', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('freeze_type')->nullable();
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
        Schema::dropIfExists('freezes');
    }
}
