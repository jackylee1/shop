<?php

namespace Evention\Services;

use Evention\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService extends Service
{
    /**
     * @var Setting
     */
    protected $setting;

    /**
     * Settings constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function createIfHasnt(array $data)
    {
        if (! isset($data['key'])) {
            throw new \Exception('[Key] field required');
        }

        if (! $this->has($data['key'])) {
            return $this->setting->create($data);
        }
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    public function createMassIfHasnt(array $data)
    {
        foreach ($data as $item) {
            $this->createIfHasnt($item);
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function has($key)
    {
        return $this->setting->where('key', $key)->exists();
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        if (! Cache::has(self::getCacheKey($key))) {
            Cache::forever(self::getCacheKey($key), app(self::class)->value($key, $default));
        }

        return Cache::get(self::getCacheKey($key), $default);
    }

    /**
     * @param $key
     *
     * @return string
     */
    protected static function getCacheKey($key)
    {
        return 'setting-'.$key;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function value($key, $default = null)
    {
        if (! $this->has($key)) {
            return $default;
        }

        return $this->setting
            ->where('key', $key)
            ->value('value');
    }
}
