<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;

abstract class FilterAbstract
{
    public static abstract function getFilter(Request $request): array;
}