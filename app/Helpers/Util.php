<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Util
{
    public static function now()
    {
        return(Carbon::now()->toDateTimeString());
    }

    public static function current_time()
    {
        return(Carbon::now()->getTimestamp());
    }

    /**
     * @return string
     */
    public static function today()
    {
        return(Carbon::now()->toDateString());
    }

    /**
     * @param string|null $str
     * @return mixed|string|null
     */
    public static function uuid()
    {
        return strtoupper(Str::uuid());
    }
}
