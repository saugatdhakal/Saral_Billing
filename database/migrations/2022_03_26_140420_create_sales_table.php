<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->string('fiscal_year');
            $table->string('transaction_date');
            $table->string('sales_date');
            $table->string('invoice_number')->unique();
            $table->string('total_amount')->default('0');
            $table->string('discount_amount')->default('0');
            $table->string('extra_charges')->default('0');
            $table->string('rounding')->default('0');
            $table->string('net_amount')->default('0');
            $table->unsignedBigInteger('is_bill_printed')->default('0');
            $table->string('printed_by')->nullable();
            $table->enum('sales_type',['DEBIT','CREDIT']);
            $table->string('paymode')->nullable();
            $table->enum('status',['RUNNING','COMPLETED','RETURN']);
            // softdelete,timestamp and userstamp
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
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
        Schema::table('sales',function(Blueprint $table){
            $table->dropSoftDeletes();
        });

    }
}
