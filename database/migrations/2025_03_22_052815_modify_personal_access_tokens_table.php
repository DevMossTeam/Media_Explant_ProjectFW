<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyPersonalAccessTokensTable extends Migration
{
    public function up()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // Hapus primary key lama
            $table->dropPrimary(['id']);

            // Ubah kolom id dan tokenable_id menjadi varchar (UUID)
            $table->string('id', 36)->change();
            $table->string('tokenable_id', 36)->change();

            // Jadikan id sebagai primary key kembali
            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropPrimary(['id']);

            // Kembalikan id dan tokenable_id ke bigint
            $table->bigIncrements('id')->change();
            $table->unsignedBigInteger('tokenable_id')->change();
        });
    }
}
