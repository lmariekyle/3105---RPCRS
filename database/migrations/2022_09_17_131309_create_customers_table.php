<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('ACTIVE');

            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');

            $table->dateTime('membership_start_date')->useCurrent();
            $table->dateTime('membership_end_date');
            $table->dateTime('membership_expires_in');

            $table->date('date_of_birth');

            $table->string('phone_number')->nullable();
            $table->string('email')->unique();

            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('street_name')->nullable();
            $table->string('house_number')->nullable();

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
        Schema::dropIfExists('customers');
    }
}
