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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->integer('numero_cuota');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_pago');
            $table->enum('metodo_pago', ['efectivo', 'transferencia', 'tarjeta']);
            $table->string('referencia')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')->on('contracts')
                ->onDelete('cascade');
        });

        if (!Schema::hasColumn('contracts', 'fecha_fin')) {
            Schema::table('contracts', function (Blueprint $table) {
                $table->date('fecha_fin')->nullable()->after('fecha_inicio');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');

        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('fecha_fin');
        });
    }
}; 