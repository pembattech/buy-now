<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $safeParms = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    /**
     * Transforms request query parameters into an array suitable for Eloquent queries.
     * 
     * @param \Illuminate\Http\Request $request
     * @return array Eloquent query conditions
     */
    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {


                if (isset($query[$operator])) {

                    // If the operator is 'like', append wildcards
                    if ($operator === 'like') {
                        $query[$operator] = '%' . $query[$operator] . '%';
                    }

                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
