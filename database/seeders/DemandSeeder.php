<?php

namespace Database\Seeders;

use App\Models\Demand;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemandSeeder extends Seeder
{
    public function run()
    {
        // Obtém o usuário atendente
        $attendee = User::where('email', 'atendente@proconecta.com')->first();

        // Cria algumas demandas
        Demand::create([
            'user_id' => $attendee->id,
            'title' => 'Problema com fornecedor XYZ',
            'description' => 'O fornecedor não entregou o produto no prazo.',
            'supplier_name' => 'Fornecedor XYZ',
            'supplier_document' => '123.456.789-00',
            'supplier_phone' => '(11) 98765-4321',
            'supplier_email' => 'fornecedor@xyz.com',
            'status' => 'aguardando_analise',
        ]);

        Demand::create([
            'user_id' => $attendee->id,
            'title' => 'Reclamação sobre produto defeituoso',
            'description' => 'O produto chegou com defeito.',
            'supplier_name' => 'Fornecedor ABC',
            'supplier_document' => '987.654.321-00',
            'supplier_phone' => '(11) 91234-5678',
            'supplier_email' => 'fornecedor@abc.com',
            'status' => 'em_analise',
        ]);
    }
}