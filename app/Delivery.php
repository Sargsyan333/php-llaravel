<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    /**
     * SHIPMENT AVAILABLE AFTER n Days
     */
    const SHIPMENT_AVAILABLE_AFTER = 3;

    protected $fillable = [
        'delivery_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Delivery::class);
    }

    /**
     * @return mixed
     */
    public static function getDeliveries()
    {
       return self::where(
           'delivery_date' ,
           '>' ,
           now()->addDays(self::SHIPMENT_AVAILABLE_AFTER)
       )->get();
    }
}
