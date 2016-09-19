<?php

namespace Magic\Models;

use Magic\Traits\MagicRelationship;
use Illuminate\Database\Eloquent\Model;

class ImageGroup extends Model
{
    // Trait
    use MagicRelationship;

    //
    protected $table = 'magic_images';
    protected $fillable = [];

    //
    static function getMagicRelationship($model, $magic = array()){

        //
        return  $model->hasMany(get_class(), 'ref_id')
                      ->where('magic_id', $magic['id'])
                      ->orderBy('position');
    }

    //
    public function ref()
    {
        $magic = config('magic.relationships', collect())
                    ->where('id', $this->magic_id)
                    ->first();

        return $this->belongsTo($magic['model']);
    }
}
