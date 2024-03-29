<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Accounts', function (Blueprint $table) {
        $table->id();
        $table->enum('account_type',['BUSINESS','INDIVIDUAL']);
        $table->string('name');
        $table->string('shop_name')->nullable();
        $table->string('home_address')->nullable();
        $table->string('shop_address')->nullable();
        $table->string('contact_number_1')->unique();
        $table->string('contact_number_2')->nullable()->unique();
        $table->string('email')->nullable();
        $table->string('vat_number')->nullable()->unique();
        $table->string('pan_number')->nullable()->unique();
        $table->string('remark')->nullable();
        $table->enum('status',['ACTIVE','INACTIVE']);
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
        // Schema::table('Accounts',function(Blueprint $table){
        //     $table->dropSoftDeletes();
        // });
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('Accounts');
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        // $table->dropForeign('accounts_created_by_foreign');
        // $table->dropColumn('created_by');
    }

}
