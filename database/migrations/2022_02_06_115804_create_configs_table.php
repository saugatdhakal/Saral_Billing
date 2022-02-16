            <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Company Name');
            $table->string('address')->default('Company Address');
            $table->string('contact_number')->default('0123456789');
            $table->string('email')->default('company@email.com');
            $table->string('print_notes')->nullable();
            $table->unsignedBigInteger('fiscal_year')->nullable();
            $table->unsignedBigInteger('sales_bill_number')->nullable();
            $table->unsignedBigInteger('sales_return_bill_number')->nullable();
            $table->unsignedBigInteger('purchase_bill_number')->nullable();
            $table->unsignedBigInteger('purchase_return_bill_number')->nullable();
            // $table->boolean('use_expire_date')->nullable();
            $table->boolean('show_discount')->nullable();
            $table->boolean('show_balance')->nullable();
            $table->boolean('show_mrp')->nullable();
            $table->boolean('use_expenses')->nullable();
            $table->unsignedBigInteger('credit_over_due_warning')->nullable();
            $table->unsignedBigInteger('credit_due_date')->nullable();
            $table->unsignedBigInteger('minimum_stock_warning')->nullable();
            $table->unsignedBigInteger('minimum_stock_info')->nullable();
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
        Schema::dropIfExists('configs');
    }
}
