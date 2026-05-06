<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('local_listings', function (Blueprint $table): void {
            if (! Schema::hasColumn('local_listings', 'phone')) {
                $table->string('phone', 30)->nullable();
            }
            if (! Schema::hasColumn('local_listings', 'address')) {
                $table->string('address')->nullable();
            }
            if (! Schema::hasColumn('local_listings', 'neighborhood')) {
                $table->string('neighborhood')->nullable();
            }
            if (! Schema::hasColumn('local_listings', 'sector')) {
                $table->string('sector')->nullable();
            }
            if (! Schema::hasColumn('local_listings', 'services')) {
                $table->text('services')->nullable();
            }
            if (! Schema::hasColumn('local_listings', 'cnpj')) {
                $table->string('cnpj', 30)->nullable();
            }
            if (! Schema::hasColumn('local_listings', 'show_cnpj')) {
                $table->boolean('show_cnpj')->default(false);
            }
            if (! Schema::hasColumn('local_listings', 'responsible')) {
                $table->string('responsible')->nullable();
            }
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('local_listings', function (Blueprint $table): void {
            $table->dropUnique('local_listings_user_id_unique');
            $table->dropColumn(['phone', 'address', 'neighborhood', 'sector', 'services', 'cnpj', 'show_cnpj', 'responsible']);
        });
    }
};
