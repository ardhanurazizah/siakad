<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomTableMahasiswaMatakuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->unsignedBigInteger('nilai_angka')->after('matakuliah_id')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->dropColumn('nilai_angka');
            
        });
    }
}
