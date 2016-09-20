<?php

namespace Magic\Console\Commands;

use Illuminate\Console\Command;

class ListAll extends Command
{
    //
    protected $description = 'Lista todos os relacionamentos mágicos';

    //
    protected $signature = 'bw:magic-list
                            {--id= : Filtra os resultados por ID}';

    //
    public function handle()
    {
        //
        $data = [];
        $id = $this->option('id');
        $results = \MagicRelationships::get($id);

        foreach ($results as $i) {
            $properties  = "ID: {$i['id']}\n";
            $properties .= "Type: {$i['type']}\n";
            $properties .= "Parent: {$i['parent']}\n";

            $data[] = [
                $i['model'],
                $i['name'],
                $properties
            ];
        };

        //
        $this->table(['Model', 'Name', 'Properties'], $data);
    }
}
