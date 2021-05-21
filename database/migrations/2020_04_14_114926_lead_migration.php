<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeadMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //creating lead generation database

        Schema::create('leads',function(Blueprint $table){

            $table->bigIncrements('leadId');
            $table->string('leadEmail',100)->unique();
            $table->string('leadContact',15)->unique();
            $table->string('leadName',100);
            $table->string('leadProduct',100);
            $table->string('leadGeneratedFrom',500);
            $table->integer('leadProductQty')->nullable()->unsigned();
            $table->integer('leadStatus')->nullable()->unsigned();

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
        // Remove Database Migration Goes Down
        Schema::dropIfExists('leads');
    }
}
