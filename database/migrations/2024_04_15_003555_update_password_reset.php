<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->id()->after('email');
            $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->dropColumn(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn(['id']);
            $table->dropForeign(['id', 'user_id']);
            $table->string('email');

        });
    }
};
