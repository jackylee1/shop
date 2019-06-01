<?php

namespace Evention\Services\Facades;

use Illuminate\Support\Facades\Facade;
use Evention\Services\TemporaryUserService;

/**
 * @method static \App\Models\User\TemporaryUser getByToken(string $token)
 * @method static \App\Models\User\TemporaryUser user()
 * @method static int id()
 * @method static string|null getCurrentToken()
 * @method static bool hasToken(string $token = null)
 * @method static bool|null deactivate()
 * @method static \App\Models\User\TemporaryUser getByTokenOrCreate(string $token)
 * @method static \App\Models\User\TemporaryUser create(string $token)
 * @method static string generateToken()
 *
 * @see TemporaryUserService
 */
class TemporaryUser extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'service.temporary_user';
    }
}
