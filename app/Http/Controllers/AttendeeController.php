<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    // Dashboard do atendente
    public function dashboard()
    {
        $user = auth()->user();

        // Total de demandas trabalhadas pelo atendente
        $totalDemandsWorked = Demand::where('assigned_to', $user->id)->count();

        // Demandas pendentes de análise de arquivos
        $pendingFileAnalysis = Demand::where('status', 'aguardando_validacao_arquivos')->count();

        // Demandas pendentes de análise geral
        $pendingGeneralAnalysis = Demand::where('status', 'aguardando_analise')->count();

        return view('attendee.dashboard', compact(
            'totalDemandsWorked',
            'pendingFileAnalysis',
            'pendingGeneralAnalysis'
        ));
    }

    // Listar demandas atribuídas ao atendente
    public function listDemands()
    {
        $user = auth()->user();
        $demands = Demand::where('assigned_to', $user->id)->get();
        return view('attendee.demands', compact('demands'));
    }
}