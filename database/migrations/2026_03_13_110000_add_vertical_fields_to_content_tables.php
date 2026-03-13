<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('local_listings', function (Blueprint $table): void {
            $table->string('logo_path')->nullable()->after('category');
            $table->string('phone_whatsapp', 30)->nullable()->after('logo_path');
            $table->string('address_neighborhood')->nullable()->after('phone_whatsapp');
            $table->string('opening_hours')->nullable()->after('address_neighborhood');
            $table->string('contact_link')->nullable()->after('opening_hours');
        });

        Schema::table('cultural_events', function (Blueprint $table): void {
            $table->string('neighborhood')->nullable()->after('event_date');
            $table->string('event_type')->nullable()->after('neighborhood');
            $table->string('pricing_type', 20)->default('gratuito')->after('event_type');
            $table->string('audience_type', 30)->nullable()->after('pricing_type');
            $table->string('organizer_name')->nullable()->after('audience_type');
        });

        Schema::table('classified_items', function (Blueprint $table): void {
            $table->string('main_photo_path')->nullable()->after('kind');
            $table->string('category')->nullable()->after('main_photo_path');
            $table->string('neighborhood')->nullable()->after('category');
            $table->string('advertiser_name')->nullable()->after('neighborhood');
            $table->string('whatsapp_number', 30)->nullable()->after('advertiser_name');
        });
    }

    public function down(): void
    {
        Schema::table('local_listings', function (Blueprint $table): void {
            $table->dropColumn(['logo_path', 'phone_whatsapp', 'address_neighborhood', 'opening_hours', 'contact_link']);
        });

        Schema::table('cultural_events', function (Blueprint $table): void {
            $table->dropColumn(['neighborhood', 'event_type', 'pricing_type', 'audience_type', 'organizer_name']);
        });

        Schema::table('classified_items', function (Blueprint $table): void {
            $table->dropColumn(['main_photo_path', 'category', 'neighborhood', 'advertiser_name', 'whatsapp_number']);
        });
    }
};
