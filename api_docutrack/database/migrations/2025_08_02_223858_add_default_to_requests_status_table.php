<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('requests_status', function (Blueprint $table) {
        $table->string('default')->nullable(); // O puedes quitar nullable si debe ser obligatorio
    });
}

public function down()
{
    Schema::table('requests_status', function (Blueprint $table) {
        $table->dropColumn('default');
    });
}
};
