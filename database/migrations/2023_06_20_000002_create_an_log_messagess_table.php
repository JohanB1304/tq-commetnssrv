<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('an_log_messages', function (Blueprint $table) {
            $table->uuid('guid')->primary();
            $table->uuid('annotation_id');
            $table->string('ref_id');
            $table->string('user_id');
            $table->string('status')->nullable();
            $table->string('tenant_id')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('an_log_messages');
    }
};