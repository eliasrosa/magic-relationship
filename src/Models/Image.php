<?php

namespace Magic\Models;

use Magic\Traits\MagicRelationship;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Trait
    use MagicRelationship;

    //
    protected $table = 'magic_images';
    protected $fillable = [];

    //
    static function getMagicRelationship($model, $magic = array()){

        //
        return  $model->hasOne(get_class(), 'ref_id')
                      ->where('magic_id', $magic['id']);
    }

    //
    public function ref()
    {
        $magic = \MagicRelationships::get($this->magic_id)->first();

        return $this->belongsTo($magic['model']);
    }
}
