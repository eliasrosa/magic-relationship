<?php

namespace Magic\Models;

use Magic\Traits\MagicRelationship;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Trait
    use MagicRelationship;

    //
    protected $table = 'magic_tags';
    protected $fillable = ['name'];

    //
    static function getMagicRelationship($model, $magic = array()){

        //
        return $model->morphToMany(get_class(), 'taggable', 'magic_tags_rel');
    }

    //
    public function ref()
    {
        $config = config('magic.relationships', collect())
                    ->where('id', $this->magic_id)
                    ->first();

        return $this->morphedByMany($config['model'], 'taggable', 'magic_tags_rel');
    }


}
