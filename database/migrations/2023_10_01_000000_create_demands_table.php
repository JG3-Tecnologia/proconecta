<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('supplier_name');
            $table->string('supplier_document');
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('status')->default('aguardando_validacao_arquivos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demands');
    }
}