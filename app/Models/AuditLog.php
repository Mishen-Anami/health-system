<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'auditlogs'; 
    protected $fillable =['user_id','action','details'];
   
}
