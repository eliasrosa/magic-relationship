<?php

namespace Magic\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'magic_images';
    protected $fillable = [];

    //
    static function getMagicRelationship($model, $ref_name, $params = array()){

        //
        $type = get_class($model) . '::' . $ref_name;

        //
        return  $model->hasOne(get_class(), 'ref_id')
                    ->where('ref_type', $type);
    }
}
