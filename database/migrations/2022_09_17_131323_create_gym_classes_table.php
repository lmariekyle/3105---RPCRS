<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('gym_classes', function (Blueprint $table) {
            
            $table->id();

            $table->string('name');
            $table->string('status')->default('ACTIVE');
            $table->mediumText('description');

            $table->integer('max_enrollees',false);
            $table->integer('cur_number',false);

            $table->float('price');

            $table->string('schedule'); 
            $table->string('time');
                        
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gym_classes');
    }
}
