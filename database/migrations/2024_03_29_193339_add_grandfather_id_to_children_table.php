<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('children', function (Blueprint $table) {
            // Define the foreign key column
            $table->unsignedBigInteger('grandfather_id');

            // Define the foreign key constraint
            $table->foreign('grandfather_id')
                ->references('id')
                ->on('grand_fathers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropForeign(['grandfather_id']);
            $table->dropColumn('grandfather_id');
        });
    }
};
