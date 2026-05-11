<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name', 255)->after('code');
            $table->string('phone', 20)->after('customer_name');
            $table->string('email', 255)->after('phone');
            $table->string('address', 500)->after('email');
            $table->string('payment_method', 50)->default('cod')->after('address');
            $table->text('note')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'phone', 'email', 'address', 'payment_method', 'note']);
        });
    }
};
