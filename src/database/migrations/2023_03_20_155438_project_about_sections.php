<?php

use App\Enums\ProjectStatusEnum;
use App\Enums\PublishStatusEnum;
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
        Schema::create('project_about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('rera', 500);
            $table->text('left_image');
            $table->text('about_logo');
            $table->text('description');
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->timestamps();
            $table->index(['project_id', 'id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_about_sections');
    }
};
