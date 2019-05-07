<?php

namespace Evention\Services;

use App\Models\User\TemporaryUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;

class TemporaryUserService extends Service
{
    /**
     * @var TemporaryUser
     */
    protected $model;

    /**
     * @var TemporaryUser
     */
    protected $user;

    /**
     * TemporaryUserService constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->model = new TemporaryUser();
    }

    /**
     * @return TemporaryUser
     */
    public function user()
    {
        return $this->user ?? $this->getByToken($this->getCurrentToken());
    }

    /**
     * @param $token
     *
     * @return TemporaryUser
     */
    public function getByToken($token)
    {
        return $this->user = $this->model->where('token', $token)->first();
    }

    /**
     * @return string|null
     */
    public function getCurrentToken()
    {
        return \Cookie::get(config('evention.temporary_user.cookie'));
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function hasToken($token = null)
    {
        $token = $token ?? $this->getCurrentToken();

        return $this->model->where('token', $token)->exists();
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->user()->id;
    }

    /**
     * @return bool|null
     *
     * @throws \Exception
     */
    public function deactivate()
    {
        return $this->user()->delete();
    }

    /**
     * Get the first record matching the token or create it
     *
     * @param null|string $token
     *
     * @return TemporaryUser
     */
    public function getByTokenOrCreate($token = null)
    {
        if(! is_null($token)) {
            if (! is_null($user = $this->getByToken($token))) {
                return $this->user = $user;
            }
        }

        return $this->user = $this->create($this->generateToken());
    }

    /**
     * Create new TemporaryUser
     *
     * @param $token
     *
     * @return TemporaryUser
     */
    public function create($token)
    {
        return $this->user = $this->model->create([
            'token' => $token
        ]);
    }

    /**
     * @return string
     */
    public function generateToken(): string
    {
        return \Hash::make(Str::random(19));
    }
}