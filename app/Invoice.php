<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Invoice extends Model
{
    use Notifiable;
    //
    protected $fillable = ['name','amount','email','description','charge_id'];

    public function user(){
      return $this->belongsTo('App\User');
    }

}
