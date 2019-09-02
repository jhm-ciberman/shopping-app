<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();

            $table->boolean('is_editable')->default(false);

            // The full name of the person asociated with this address (for shipping or billing)
            $table->string('contact'); // Ex: "John Connor"
            $table->string('phone')->nullable(); // Ex: "+54 123 456423"

            // Two letters ISO 3166-1 alfa-2
            $table->string('country_code', 2); // Ex: "AR"

            // Street info
            $table->string('street_name')->nullable(); // Ex: "Belgrano Street"
            $table->string('street_number')->nullable(); // Ex: "123"
            $table->string('zip_code'); // Ex: "7600"
            $table->string('state'); // Ex: "Buenos Aires" 
            $table->string('city'); // Ex: "Mar del Plata"

            // Floor, department, or any aditional street info
            $table->string('additional_info')->nullable(); // Ex: "Suite 3C"
            
            // Additional streets for shipping reference
            $table->string('between')->nullable(); // Ex: "Between La Rioja and Catamarca"
            
            // Another field for references
            $table->string('references')->nullable(); // Ex: "The big red house"

            // Geocoding info
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
