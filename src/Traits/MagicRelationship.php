<?php

namespace Magic\Traits;

use LogicException;

trait MagicRelationship
{
    //
    private $tmp_config = [

        // hasOne
        'imagem' => 'Magic\Models\Image',
        'imagem2' => 'Magic\Models\Image',

        // hasMany
        'galeria' => 'Magic\Models\Galery',
    ];

    //
    private function getMagicModelFromName($key)
    {
        if(isset($this->tmp_config[$key])){
            return $this->tmp_config[$key];
        }else{
            return false;
        }
    }

    //
    public function __get($key)
    {
        $magic_model = $this->getMagicModelFromName($key);
        if($magic_model !== false){

            if ($this->relationLoaded($key)) {
                return $this->relations[$key];
            }

            $relations = $magic_model::getMagicRelationship($this, $key);
            return $this->relations[$key] = $relations->getResults();
        }

        return parent::__get($key);
    }

    //
    public function __call($method, $parameters)
    {

        $magic_model = $this->getMagicModelFromName($method);
        if($magic_model !== false){

            //
            return $magic_model::getMagicRelationship($this, $method);
        }

        return parent::__call($method, $parameters);
    }
}
