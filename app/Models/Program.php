<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable =['name','description'];
    public function clients(){
        return $this->belongsToMany(Client::class, 'enrollments');
    }
}
