<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPermohonanTable extends Migration
{
    public function up()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->string('status')->default('menunggu')->after('alasan_cuti');
        });
    }

    public function down()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
