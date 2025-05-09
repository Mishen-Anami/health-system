<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable =['first_name','last_name','email','phone','date_of_birth'];
    public function programs(){
        return $this->belongsToMany(Program::class, 'enrollments');
    }
}
