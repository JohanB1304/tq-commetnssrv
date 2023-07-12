<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('annotation.main_table_name'), function (Blueprint $table) {
            $table->uuid('guid')->primary();
            $table->string('ref_id');
            $table->string('ref_entity')->nullable();
            $table->string('user_id');
            $table->text('comment')->nullable();
            $table->string('created_by', 64)->nullable();
            $table->string('updated_by', 64)->nullable();
            $table->string('expired_by', 64)->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->string('tenant_id')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists(config('annotation.main_table_name'));
    }
};
