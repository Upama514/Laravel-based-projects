<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Database এ table create করার main function
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // auto increment primary key (id)
            
            // 🧑‍💻 Each blog belongs to one user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // user_id → connects with users table
            // onDelete('cascade') মানে user delete হলে তার blog গুলোও delete হবে

            $table->string('title');   // Blog title
            $table->text('content');   // Blog content / description

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     * যদি rollback করা লাগে তাহলে table drop করবে
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
