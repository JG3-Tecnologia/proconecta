<?php

namespace Database\Seeders;

use App\Models\Demand;
use App\Models\Interaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    public function run()
    {
        // Obtém a primeira demanda e o usuário atendente
        $demand = Demand::first();
        $attendee = User::where('email', 'atendente@proconecta.com')->first();

        // Cria interações para a demanda
        Interaction::create([
            'demand_id' => $demand->id,
            'user_id' => $attendee->id,
            'message' => 'Solicitamos mais informações sobre o problema.',
            'status' => 'aguardando_resposta',
        ]);

        Interaction::create([
            'demand_id' => $demand->id,
            'user_id' => $attendee->id,
            'message' => 'O fornecedor foi notificado sobre o problema.',
            'status' => 'em_analise',
        ]);
    }
}