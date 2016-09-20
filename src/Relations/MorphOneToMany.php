<?php

namespace Magic\Relations;

use Illuminate\Database\Eloquent\Collection;

class MorphOneToMany extends \Illuminate\Database\Eloquent\Relations\MorphToMany
{
    //
    public function getResults()
    {
        if($this->inverse === false){
            return $this->query->first();
        }

        return $this->query->get();
    }

    //
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);

        foreach ($models as $model) {
            $key = $model->getKey();

            //
            if (isset($dictionary[$key])) {
                $type = ($this->inverse === false) ? 'one' : 'many';
                $value = $this->getRelationValue($dictionary, $key, $type);
                $model->setRelation($relation, $value);
            }else{
                $model->setRelation($relation, null);
            }
        }

        return $models;
    }

    //
    protected function getRelationValue(array $dictionary, $key, $type)
    {
        $value = $dictionary[$key];
        return $type == 'one' ? reset($value) : $this->related->newCollection($value);
    }
}
