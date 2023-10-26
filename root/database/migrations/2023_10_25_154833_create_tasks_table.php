<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id("ta_id");
            $table->string("ta_description",100)->default("");
            $table->integer("ta_usid",false,true);
            $table->time("ta_estimatedtime");
            $table->time("ta_usedtime")->nullable();
            $table->dateTime("ta_createdat")->useCurrent();
            $table->dateTime("ta_completedat")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
