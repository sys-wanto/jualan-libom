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
        Schema::create('dati2', function (Blueprint $table) {
            // $table->id();
            $table->char('kd_propinsi', 2);
            $table->char('kd_dati2', 2);
            $table->string('nm_dati2')->nullable();
            $table->foreign('kd_propinsi')->references('kd_propinsi')->on('propinsi');
            $table->primary(['kd_propinsi','kd_dati2']);

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
