<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id')->unique();
            $table->date('createdAt');
            $table->date('paymentDue')->nullable();
            $table->string('description')->nullable();
            $table->integer('paymentTerms')->nullable();
            $table->string('clientName')->nullable();
            $table->string('clientEmail')->nullable();
            $table->string('status');
            $table->string('senderAddress_street')->nullable();
            $table->string('senderAddress_city')->nullable();
            $table->string('senderAddress_postCode')->nullable();
            $table->string('senderAddress_country')->nullable();
            $table->string('clientAddress_street')->nullable();
            $table->string('clientAddress_city')->nullable();
            $table->string('clientAddress_postCode')->nullable();
            $table->string('clientAddress_country')->nullable();
            $table->decimal('total', 10, 2)->nullable(); // Making 'total' nullable
            $table->timestamps();

            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
