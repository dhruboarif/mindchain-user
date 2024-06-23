<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserPayment;

class Withdraw extends Model
{
    use HasFactory;
    protected $table ="withdraws";
      protected $guarded =[];
    public function user()
    {

         return $this->belongsTo(User::class, 'user_id');

    }
    public function payment()
    {

         return $this->belongsTo(UserPayment::class, 'payment_method_id');

    }
}
