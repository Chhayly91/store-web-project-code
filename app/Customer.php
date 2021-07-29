<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //join relationship with phone number
    public function phoneNumbers(){
        return $this->hasMany('App\PhoneNumber');
    }

    //join relationship with invoice
    public function invoices(){
        return $this->hasMany('App\Invoice');
    }
}
