<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_time', 'end_time', 'event_date', 'user_id'];

    // Define o relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('event_date');
            $table->foreignId('user_id')
                ->constrained() // Define a chave estrangeira
                ->onDelete('cascade'); // Define o comportamento de exclusão em cascata
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}

