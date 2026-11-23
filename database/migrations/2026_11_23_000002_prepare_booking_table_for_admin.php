<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The website already writes bookings to `tbl_booking_det`.
 * This migration creates the table when it is missing (fresh installs) and,
 * when it already exists, only ADDS the columns the admin panel needs.
 * Existing booking data is never modified or removed.
 */
class PrepareBookingTableForAdmin extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_booking_det')) {
            Schema::create('tbl_booking_det', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('cus_name');
                $table->string('email');
                $table->string('contact_no', 50)->nullable();
                $table->string('datetime', 50)->nullable();
                $table->string('service_name')->nullable();
                $table->string('persons', 50)->nullable();
                $table->string('kids', 20)->nullable();
                $table->text('message')->nullable();
                $table->dateTime('cre_datetime')->nullable();
            });
        }

        // Make sure the table has a primary key so rows can be edited individually.
        $primary = DB::select("SHOW KEYS FROM `tbl_booking_det` WHERE Key_name = 'PRIMARY'");
        if (empty($primary)) {
            DB::statement('ALTER TABLE `tbl_booking_det` ADD `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
        }

        Schema::table('tbl_booking_det', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_booking_det', 'status')) {
                $table->string('status', 20)->default('pending')->index();
            }
            if (!Schema::hasColumn('tbl_booking_det', 'package_id')) {
                $table->unsignedBigInteger('package_id')->nullable()->index();
            }
            if (!Schema::hasColumn('tbl_booking_det', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('tbl_booking_det', 'admin_notes')) {
                $table->text('admin_notes')->nullable();
            }
            if (!Schema::hasColumn('tbl_booking_det', 'source')) {
                $table->string('source', 20)->default('website');
            }
            if (!Schema::hasColumn('tbl_booking_det', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('tbl_booking_det', function (Blueprint $table) {
            foreach (['status', 'package_id', 'total_amount', 'admin_notes', 'source', 'updated_at'] as $column) {
                if (Schema::hasColumn('tbl_booking_det', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
