<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $table = 'user_verifications';

    protected $guarded = [''];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
