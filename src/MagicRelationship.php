<?php

namespace Magic;

use \Magic\Models\Relationship;

class MagicRelationship {

    //
    private $data;

    //
    public function __construct()
    {
        $this->data = collect();
    }

    //
    static public function register($config_key)
    {
        return (new static())->loadConfig($config_key);
    }

    //
    public function loadConfig($config_key)
    {
        //
        $config = config($config_key, []);
        foreach ($config as $model => $relationships) {
           $this->createCollect($model, null, $relationships);
        }

        //
        $this->storeData();
    }

    //
    private function storeData()
    {
        $relationships = config('magic.relationships', collect());
        $merged = $relationships->merge($this->data);

        //
        \Config::set('magic.relationships', $merged);
    }

    //
    public function createCollect($model, $parent, $relationships)
    {

        foreach ($relationships as $name => $params) {

            $type = $this->getTypeClass($params['type']);
            $id = $this->getRelationshipId($model, $name, $type, $parent);

            $data = array_merge($params, [
                'id' => $id,
                'model' => $model,
                'name' => $name,
                'type' => $type,
                'parent' => $parent,
            ]);

            //
            $this->data->push($data);

            //
            if(isset($params['relationships']) && is_array($params['relationships'])){
                $relationships_child = $params['relationships'];

                if(is_null($parent)){
                    $parent_new = $data['model'] . '::' . $data['name'];
                }else{
                    $parent_new = $parent . '.' . $name;
                }

                //
               $this->createCollect($data['type'], $parent_new, $relationships_child);
            }
        }
    }

    //
    public function getRelationshipId($model, $name, $type, $parent)
    {
        return md5($model . $name . $type . $parent);
    }

    //
    public function getTypeClass($type)
    {

        if(strpos($type, "\\") !== false){
            return $type;
        }else{
            return 'Magic\Models\\' . $type;
        }
    }
}
