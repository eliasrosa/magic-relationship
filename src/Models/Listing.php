<?php

namespace Magic\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Magic\Traits\MagicRelationship;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    // Trait
    use MagicRelationship;

    //
    protected $table = 'magic_listings';
    protected $fillable = ['magic_id'];

    //
    static function getMagicRelationship($model, $magic = array()){

        //
        $local_key = isset($magic['local_key']) ? $magic['local_key'] : $magic['name'] . '_id';

        //
        return  $model->hasOne(get_class(), 'id', $local_key);
    }

    //
    public function ref()
    {
        $magic = config('magic.relationships', collect())
                    ->where('id', $this->magic_id)
                    ->first();

        //
        $foreign_key = isset($magic['local_key']) ? $magic['local_key'] : $magic['name'] . '_id';

        //
        return $this->hasMany($magic['model'], $foreign_key, 'id');
    }
}
