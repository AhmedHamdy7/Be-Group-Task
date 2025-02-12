<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilterHelper
{
    /**
     * Dynamically apply filters to the query based on request data.
     *
     * @param Builder $query
     * @param Request $request
     * @param array $filterableColumns
     * @return Builder
     */
    public static function applyFilters(Builder $query, Request $request, array $filterableColumns): Builder
    {

        foreach ($filterableColumns as $column => $type) {
            if ($column == 'created_at' && $request->has('start_date') && $request->has('end_date')) {
                $startDate = $request->get('start_date');
                $endDate = $request->get('end_date');
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            if ($request[$column] != null) {
                $value = $request->get($column);
                if (is_array($type)) {
                    if ($type['type'] === 'concat') {
                        $query->where(function ($q) use ($type, $value) {
                            $concatExpression = implode(", ' ', ", array_map(function ($col) {
                                return "`$col`";
                            }, $type['columns']));
                            $q->whereRaw("CONCAT($concatExpression) LIKE ?", ["%$value%"]);
                        });
                    }
                } else {
                    switch ($type) {
                        case 'like':
                            $query->where($column, 'like', '%' . $value . '%');
                            break;
                        case 'exact':
                            $query->where($column, $value);
                            break;
                        case 'date_range':
                                [$startDate, $endDate] = explode(',', $value);
                                $query->whereBetween($column, [$startDate, $endDate]);
                                break;
                        default:
                            throw new \Exception("Unknown filter type: $type");
                    }
                }
            }
        }

        return $query;
    }
}
