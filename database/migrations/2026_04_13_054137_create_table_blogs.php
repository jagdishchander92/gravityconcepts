<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('title');
            $table->string('img')->nullable();
            $table->string('img_desc')->nullable();
            $table->json('slider')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->string('tags')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0=Inactive,1=active,2=Schedule");
            $table->tinyInteger('is_draft')->default(0)->comment("0=Not Draft,1=Draft");
            $table->datetime('published_at')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
