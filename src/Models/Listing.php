<?php

namespace Magic\Models;

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

        $related = get_class();
        $instance = new $related;

        return new \Magic\Relations\MorphOneToMany(
            $instance->newQuery(), $model, 'listable', 'magic_listings_rel',
            'listable_id', 'list_id', 'ref', false
        );
    }

    // IMPORTANTE
    // O comando \Magic\Models\Listing::with('ref') não está funcionando
    public function ref()
    {
        $magic = \MagicRelationships::get($this->magic_id)->first();

        $instance = new $magic['model'];
        return new \Magic\Relations\MorphOneToMany(
            $instance->newQuery(), $this, 'listable', 'magic_listings_rel',
            'list_id', 'listable_id', 'ref', true
        );
    }

}
