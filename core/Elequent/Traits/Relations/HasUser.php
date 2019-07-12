<?php

namespace Evention\Elequent\Traits\Relations;

use App\Models\User\User;

/**
 * Trait HasUser
 *
 * @property User $user
 */
trait HasUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
