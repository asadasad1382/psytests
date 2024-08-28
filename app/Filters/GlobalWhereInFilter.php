<?php

namespace App\Filters;

use Closure;

class GlobalWhereInFilter
{
    public $key, $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function handle($request, Closure $next)
    {
        if ($this->value) {
            return $next($request)->whereIn($this->key, $this->value);
        }
        return $next($request);
    }
}
