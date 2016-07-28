<?php

namespace Magic\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'magic_category';
    protected $fillable = ['name'];

    //
    static function getMagicRelationship($model, $ref_name, $params){

        //
        $key = isset($params['key']) ? $params['key'] : 'key';

        //
        $type = get_class($model) . '::' . $ref_name;

        //
        return  $model->hasOne(get_class(), 'id', $key)
                    ->where('ref_type', $type);
    }
}
