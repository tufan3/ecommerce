<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('avatar')->nullable();
            $table->string('provider',20)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('access_token')->nullable();
            $table->integer('category')->nullable()->default(0);
            $table->integer('product')->nullable()->default(0);
            $table->integer('offer')->nullable()->default(0);
            $table->integer('order')->nullable()->default(0);
            $table->integer('blog')->nullable()->default(0);
            $table->integer('pickup')->nullable()->default(0);
            $table->integer('ticket')->nullable()->default(0);
            $table->integer('contact')->nullable()->default(0);
            $table->integer('report')->nullable()->default(0);
            $table->integer('setting')->nullable()->default(0);
            $table->integer('userrole')->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
