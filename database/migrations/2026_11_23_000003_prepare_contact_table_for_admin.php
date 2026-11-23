<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The Contact Us form already writes to `tbl_contact_det`.
 * Creates it if missing, otherwise only adds the admin columns.
 */
class PrepareContactTableForAdmin extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_contact_det')) {
            Schema::create('tbl_contact_det', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('cus_name');
                $table->string('email');
                $table->string('mobi_num', 50)->nullable();
                $table->text('message')->nullable();
                $table->dateTime('cre_datetime')->nullable();
            });
        }

        $primary = DB::select("SHOW KEYS FROM `tbl_contact_det` WHERE Key_name = 'PRIMARY'");
        if (empty($primary)) {
            DB::statement('ALTER TABLE `tbl_contact_det` ADD `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
        }

        Schema::table('tbl_contact_det', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_contact_det', 'status')) {
                $table->string('status', 20)->default('pending')->index();
            }
            if (!Schema::hasColumn('tbl_contact_det', 'is_read')) {
                $table->boolean('is_read')->default(false);
            }
            if (!Schema::hasColumn('tbl_contact_det', 'replied_at')) {
                $table->timestamp('replied_at')->nullable();
            }
            if (!Schema::hasColumn('tbl_contact_det', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });

        if (!Schema::hasTable('contact_replies')) {
            Schema::create('contact_replies', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('contact_id')->index();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('subject');
                $table->text('body');
                $table->boolean('email_sent')->default(false);
                $table->string('email_error', 500)->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('whatsapp_click_logs')) {
            Schema::create('whatsapp_click_logs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('phone', 30)->nullable();
                $table->string('action', 100)->nullable();
                $table->string('ip', 50)->nullable();
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('contact_replies');
        Schema::table('tbl_contact_det', function (Blueprint $table) {
            foreach (['status', 'is_read', 'replied_at', 'updated_at'] as $column) {
                if (Schema::hasColumn('tbl_contact_det', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
