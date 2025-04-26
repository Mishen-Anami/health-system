<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class createAuditLogsTable extends Migration
{
    public function up()
    {
        Schema::create('auditlogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action');
            $table->text('details');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('auditlogs');
    }
}
