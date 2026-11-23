<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;

/**
 * The legacy tables (tbl_booking_det / tbl_contact_det) were created by hand, so the
 * primary key column name is not guaranteed to be "id". This trait looks it up once.
 */
trait ResolvesPrimaryKey
{
    protected static $resolvedPrimaryKeys = [];

    public function getKeyName()
    {
        $table = $this->getTable();

        if (!array_key_exists($table, static::$resolvedPrimaryKeys)) {
            $key = 'id';
            try {
                $rows = DB::connection($this->getConnectionName())
                    ->select("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'");
                if (!empty($rows) && isset($rows[0]->Column_name)) {
                    $key = $rows[0]->Column_name;
                }
            } catch (\Throwable $e) {
                // fall back to "id"
            }
            static::$resolvedPrimaryKeys[$table] = $key;
        }

        return static::$resolvedPrimaryKeys[$table];
    }
}
