<?php

namespace Magic\Traits;

use LogicException;

trait MagicRelationship
{
    //
    private function getMagicModelFromName($key)
    {
        $relationship = config('magic.relationships', collect())
            ->where('model', get_class())
            ->where('name', $key)
            ->first();

        return $relationship;
    }

    //
    public function __get($key)
    {
        $magic = $this->getMagicModelFromName($key);
        if(!is_null($magic)){

            if ($this->relationLoaded($key)) {
                return $this->relations[$key];
            }

            $relations = $magic['type']::getMagicRelationship($this, $magic);
            return $this->relations[$key] = $relations->getResults();
        }

        return parent::__get($key);
    }

    //
    public function __call($method, $parameters)
    {

        $magic = $this->getMagicModelFromName($method);
        if(!is_null($magic)){
            return $magic['type']::getMagicRelationship($this, $magic);
        }

        return parent::__call($method, $parameters);
    }
}
