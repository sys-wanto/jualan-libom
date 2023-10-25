<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            // $table->id();
            $table->char('kd_propinsi', 2);
            $table->char('kd_dati2', 2);
            $table->char('kd_kecamatan', 3);
            $table->char('kd_kelurahan', 3);
            $table->string('nm_kelurahan')->nullable();
            $table->foreign(['kd_propinsi','kd_dati2','kd_kecamatan'])->references(['kd_propinsi','kd_dati2','kd_kecamatan'])->on('kecamatan');
            $table->primary(['kd_propinsi','kd_dati2','kd_kecamatan','kd_kelurahan']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
};
