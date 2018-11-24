<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Origen extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'origenes';

    protected $fillable = [
        'id', 'origen',
    ];

    public static function findOrImport($origen){
        $obj = static::where('origen', $origen)->first();
        if (!$obj) {
            $obj = static::create([
                'origen' => strtoupper($origen),
            ]);
        }
        return $obj;
    }


}
