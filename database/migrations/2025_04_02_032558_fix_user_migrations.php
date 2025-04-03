<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Keep only the complete create_users_table migration
        DB::table('migrations')
            ->whereIn('migration', [
                '2025_04_02_031600_add_is_admin_to_users_table',
                '2025_04_02_031924_add_is_admin_to_users_table'
            ])
            ->delete();
    }

    public function down()
    {
        // Nothing to reverse
    }
};