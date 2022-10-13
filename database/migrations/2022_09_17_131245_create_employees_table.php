<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            
            $table->id();

            $table->string('status')->default('ACTIVE');
            $table->string('type')->default('STAFF');

            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');

            $table->date('date_of_birth');

            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->rememberToken();

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
        Schema::dropIfExists('employees');
    }
}
