<?php

use App\Models\DealType;
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
        Schema::create('deal_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->integer('system')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $initial_types = [
            DealType::SYSTEM_HIRE => 'Hire',
            DealType::SYSTEM_SPLIT => 'Split',
            DealType::SYSTEM_GUARANTEE => 'Guarantee',
        ];

        foreach ($initial_types as $system => $name) {
            $dealType = new DealType;
            $dealType->system = $system;
            $dealType->name = $name;
            $dealType->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_types');
    }
};
