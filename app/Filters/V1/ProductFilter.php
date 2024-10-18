<?php


namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ProductFilter extends ApiFilter
{
    protected $safeParms = [
        'id' => ['eq'],
        'name' => ['eq', 'like'],
        'price' => ['eq', 'gt', 'lt'],
        'stock' => ['eq', 'gt', 'lt'],
    ];


    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'like' => 'like',
    ];
}
