<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "payments";
    protected $fillable = [
        "amount",
        "order_group_id",
        "pg_payment_id",
        "status",
        "mode",
        "user_id",
    ];
}
