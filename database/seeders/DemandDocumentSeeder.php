<?php

namespace Database\Seeders;

use App\Models\Demand;
use App\Models\DemandDocument;
use Illuminate\Database\Seeder;

class DemandDocumentSeeder extends Seeder
{
    public function run()
    {
        // Obtém a primeira demanda
        $demand = Demand::first();

        // Cria documentos para a demanda
        DemandDocument::create([
            'demand_id' => $demand->id,
            'type' => 'identity',
            'file_path' => 'documents/identity.pdf',
        ]);

        DemandDocument::create([
            'demand_id' => $demand->id,
            'type' => 'address',
            'file_path' => 'documents/address.pdf',
        ]);
    }
}