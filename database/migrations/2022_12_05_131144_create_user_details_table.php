<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('serial_no');
            $table->unsignedInteger('file_no');
            $table->string('known_name');
            $table->string('name_as_per_passport')->nullable();
            $table->string('position_in_school');
            $table->string('profession_in_visa')->nullable();
            $table->timestamp('date_of_joining')->nullable();
            $table->string('type_of_contract')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->unsignedInteger('current_age');
            $table->string('mothers_name')->nullable();
            $table->string('fathers_name')->nullable();
            
            $table->unsignedInteger('passport_no')->nullable();
            $table->timestamp('passport_issue_date')->nullable();
            $table->timestamp('passport_expiry_date')->nullable();
            
            $table->unsignedInteger('visa_no')->nullable();

            $table->unsignedInteger('uid_no')->nullable();
            $table->timestamp('uid_issue_date')->nullable();
            $table->timestamp('uid_expiry_date')->nullable();

            $table->unsignedInteger('emirates_id_no')->nullable();
            $table->string('emirates_expiry')->nullable();
            
            $table->unsignedInteger('labour_card_no')->nullable();
            $table->string('labour_expiry')->nullable();

            $table->string('personal_number')->nullable();
            $table->string('profession_in_labour_card')->nullable();
            
            $table->string('basic_salary')->nullable();
            
            $table->string('allowances')->nullable();//place for 5 types
            // $table->string('type_of_allowance');            
            $table->timestamp('starting_date')->nullable();
            
            $table->string('responsibility_allowances')->nullable();//place for 4 types
            // $table->string('type_of_responsibility');
            $table->string('start_of_allowance')->nullable();

            $table->string('new_salary')->nullable();
            $table->string('increment')->nullable();
            $table->string('year_of_increment')->nullable();            
            
            $table->string('total_salary')->nullable();
            $table->string('bank')->nullable();//where salary transferred
            $table->string('iban')->nullable();

            //medical entitlement
            $table->string('medical_entitlement')->default('off');
            $table->string('medical_category')->nullable();
            $table->string('life_category')->nullable();
            $table->string('yearly')->nullable();
            $table->string('locally')->nullable();
            $table->unsignedInteger('medical_card_no')->nullable();
            $table->timestamp('medical_expiry_date')->nullable();

            $table->string('flight_entitlement')->default('off');
            $table->string('sector_entitlement')->default('off');
            $table->string('last_availed')->default('off');
            $table->string('visa_entitlement')->default('off');

            $table->string('last_working_day')->nullable();// very big box
            $table->string('reason_for_resignation')->nullable();
            $table->string('type_of_leaving')->nullable();
            $table->string('comment_on_leaving')->nullable();
            
            // $table->string('reason_for_leaving');
            // $table->string('unusual_reason_for_leaving_in_detail');
            
            $table->string('created_by_user_code');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
