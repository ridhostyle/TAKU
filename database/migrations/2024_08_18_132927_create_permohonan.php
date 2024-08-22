<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanTable extends Migration
{
    public function up()
    {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
            $table->date('mulai_cuti');
            $table->date('selesai_cuti');
            $table->string('jenis_cuti');
            $table->text('alasan_cuti');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permohonan');
    }
}
