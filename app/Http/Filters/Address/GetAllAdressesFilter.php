<?php

namespace App\Http\Filters\Address;

use App\Http\Filters\FilterAbstract;
use Illuminate\Http\Request;

class GetAllAdressesFilter extends FilterAbstract
{
    public static function getFilter(Request $request): array
    {
        $filterParams = array();

        $perPage = $request->query('per_page', 5);
        $page = $request->query('page', 1);

        $street_address = $request->query('street_address');
        $city = $request->query('city');
        $state = $request->query('state');
        $postal_code = $request->query('postal_code');
        $country = $request->query('country');

        $searchParams = [
            "street_address" => $street_address,
            "city" => $city,
            "state" => $state,
            "postal_code" => $postal_code,
            "country" => $country
        ];

        $filterParams = [
            "searchParams" => $searchParams,
            "perPage" => $perPage,
            "page" => $page
        ];

        return $filterParams;
    }
}
