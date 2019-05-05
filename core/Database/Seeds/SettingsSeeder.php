<?php

namespace Evention\Database\Seeds;

use Evention\Services\SettingsService;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(SettingsService::class)->createMassIfHasnt([[
            'key'        => 'sitename',
            'name'       => 'Site name',
            'value'      => config('app.name'),
            'field_type' => 'text',
            'section'    => 'main',
        ], [
            'key'        => 'paginate_count',
            'name'       => 'Elements per page',
            'value'      => 20,
            'field_type' => 'number',
            'section'    => 'main',
        ]]);
    }
}
