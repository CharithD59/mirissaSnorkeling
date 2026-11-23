<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTables extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('packages')) {
            Schema::create('packages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('short_description', 500)->nullable();
                $table->longText('description')->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->string('price_label', 50)->nullable();
                $table->string('duration', 100)->nullable();
                $table->string('pickup_time', 100)->nullable();
                $table->text('features')->nullable();          // JSON list of included items
                $table->string('image')->nullable();
                $table->string('detail_url')->nullable();
                $table->boolean('is_active')->default(true);   // available for booking
                $table->boolean('show_on_home')->default(true);
                $table->unsignedInteger('daily_capacity')->nullable(); // max guests per day
                $table->text('blocked_dates')->nullable();     // JSON list of Y-m-d dates
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('key', 150)->unique();
                $table->longText('value')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('gallery_images')) {
            Schema::create('gallery_images', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->string('caption')->nullable();
                $table->string('category', 100)->nullable();
                $table->string('image');
                $table->string('alt')->nullable();
                $table->boolean('show_on_home')->default(false);
                $table->boolean('show_in_gallery')->default(true);
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('packages');
    }
}
