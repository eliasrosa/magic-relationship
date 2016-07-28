<?php

namespace Magic\Traits;

use LogicException;

trait MagicRelationship
{
    //
    private $tmp_config = [
        'imagem' => ['model' => 'Magic\Models\Image'],
        'galeria' => ['model' => 'Magic\Models\Galery'],
        'modelo' => ['model' => 'Magic\Models\Category', 'key' => 'modelo_id'],
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
        $magic = $this->getMagicModelFromName($key);
        if($magic !== false){

            if ($this->relationLoaded($key)) {
                return $this->relations[$key];
            }

            $relations = $magic['model']::getMagicRelationship($this, $key, $magic);
            return $this->relations[$key] = $relations->getResults();
        }

        return parent::__get($key);
    }

    //
    public function __call($method, $parameters)
    {

        $magic = $this->getMagicModelFromName($method);
        if($magic !== false){

            //
            return $magic['model']::getMagicRelationship($this, $method, $magic);
        }

        return parent::__call($method, $parameters);
    }
}
