<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [''];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return array
     */
    public static function getRequiredItems()
    {
        return [
            'user' => auth()->user(),
            'products' => Product::latest()->get(),
            'deliveries' => Delivery::where('delivery_date','>',Carbon::yesterday())->latest()->get(),
        ];
    }

}
