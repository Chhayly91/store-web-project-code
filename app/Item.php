<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //join to invoiceID to invoice table
    public function invoice(){
        return $this->belongsTo('App\Invoice','invoiceID');
    }

    //join to productID to product table
    public function product(){
        return $this->belongsTo('App\Product', 'productID');
    }

}
