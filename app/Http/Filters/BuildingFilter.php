<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BuildingFilter extends AbstractFilter
{
    public const DEVELOPMENT_ID = 'development_id';
    public const COMPATIBILITY = 'compatibility';

    protected function getCallbacks(): array
    {
        return [
            self::DEVELOPMENT_ID => [$this, 'developmentId'],
            self::COMPATIBILITY => [$this, 'compatibility']
        ];
    }

    public function developmentId(Builder $builder, $values)
    {

        $builder->where(function ($b) use ($values) {
            foreach ($values as $value) {
                $b->orWhere('development_id', $value);
            }
        });
    }
    public function compatibility(Builder $builder, $value)
    {
        if (!isset($value['from'])) $value['from'] = 0;
        if (!isset($value['to'])) $value['to'] = 0;
        $builder->whereBetween('compatibility', [$value['from'], $value['to']]);
    }
}
