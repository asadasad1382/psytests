<?php

namespace App\Filters;

use Closure;

class GlobalFilter
{
    public $key, $value, $operation;

    public function __construct($key, $value, $operation = 'LIKE')
    {
        $this->key = $key;
        $this->value = $value;
        $this->operation = $operation;
    }

    public function handle($request, Closure $next)
    {
        if ($this->value) {
            if ($this->operation === 'LIKE') {
                return $next($request)->orWhere($this->key, 'LIKE', '%' . $this->value . '%');
            } else {
                return $next($request)->orWhere($this->key, "$this->operation", $this->value);
            }
        }
        return $next($request);
    }
}
