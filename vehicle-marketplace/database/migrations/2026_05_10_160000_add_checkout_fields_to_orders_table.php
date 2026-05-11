<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Note: removed ->after() for PostgreSQL compatibility
            $table->string('customer_name', 255);
            $table->string('phone', 20);
            $table->string('email', 255);
            $table->string('address', 500);
            $table->string('payment_method', 50)->default('cod');
            $table->text('note')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'phone', 'email', 'address', 'payment_method', 'note']);
        });
    }
};
