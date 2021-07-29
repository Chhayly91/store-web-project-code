<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //join relationship with invoice-item
    public function items(){
        return $this->hasMany('App\Item','invoiceID');
    }


    //join relation with Customer
    public function customer(){
        return $this->belongsTo('App\Customer','customerID');
    }
}
