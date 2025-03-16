<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('demand_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demand_id')->constrained()->onDelete('cascade');
            $table->string('type'); // identity, address, consumption
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demand_documents');
    }
}