<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turbines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('blades', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('grade')->nullable();
            $table->foreignId('turbine_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('rotors', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('grade')->nullable();
            $table->foreignId('turbine_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('hubs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('grade')->nullable();
            $table->foreignId('turbine_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('generators', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('grade')->nullable();
            $table->foreignId('turbine_id')->constrained()->cascadeOnDelete();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('turbines');
        Schema::dropIfExists('blades');
        Schema::dropIfExists('rotors');
        Schema::dropIfExists('hubs');
        Schema::dropIfExists('generators');
        Schema::enableForeignKeyConstraints();
    }
};
