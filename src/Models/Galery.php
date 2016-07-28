<?php

namespace Magic\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    //
    protected $table = 'magic_galery';
    protected $fillable = [];

    //
    static function getMagicRelationship($model, $ref_name, $params = array()){
        //
        $type = get_class($model) . '::' . $ref_name;

        //
        return  $model->hasMany(get_class(), 'ref_id')
                    ->where('ref_type', $type)
                    ->orderBy('position', 'ASC');
    }
}
