<?php

namespace App\Listeners;

use Evention\Services\BookmarkService;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClearCacheUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($event instanceof Logout) {
            BookmarkService::clearCache(temp_user());
        }

        BookmarkService::clearCache(user());
    }
}
