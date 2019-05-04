<?php

namespace Evention\Elequent\Traits\Relations;

use App\Models\User\TemporaryUser;

trait HasTemporaryUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function temporary_user()
    {
        return $this->belongsTo(TemporaryUser::class);
    }
}