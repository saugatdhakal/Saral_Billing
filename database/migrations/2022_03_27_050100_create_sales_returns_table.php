<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->id();
            $table->string('fiscal_year');
            $table->string('transaction_date');
            $table->string('sales_return_date');
            $table->string('invoice_number')->unique();
            $table->string('total_amount')->default('0');
            $table->string('discount_amount')->default('0');
            $table->string('extra_charges')->default('0');
            $table->string('rounding')->default('0');
            $table->string('net_amount')->default('0');
            $table->unsignedBigInteger('is_bill_printed')->default('0');
            $table->string('printed_by')->nullable();
            $table->foreignId('account_id')->constrained();
            $table->foreignId('sales_id')->constrained();
            $table->enum('status',['RUNNING','COMPLETED','CANCLED']);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
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
        Schema::table('sales_returns',function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
}
