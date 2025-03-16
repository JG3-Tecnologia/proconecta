<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demand;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard do admin
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalDemands = Demand::count();
        $attendeesStats = User::where('role', 'atendente')
            ->withCount(['demandsAssigned', 'demandsResolved'])
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDemands',
            'attendeesStats'
        ));
    }

    // Listar usuários
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Excluir usuário
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuário excluído com sucesso.');
    }

    // Listar demandas
    public function listDemands()
    {
        $demands = Demand::with('user')->get();
        return view('admin.demands', compact('demands'));
    }

    // Atualizar status da demanda
    public function updateDemandStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aguardando_analise,em_analise,aguardando_resposta,rejeitada,aceita',
        ]);

        $demand = Demand::findOrFail($id);
        $demand->update(['status' => $request->status]);

        return redirect()->route('admin.demands')->with('success', 'Status da demanda atualizado com sucesso.');
    }

    // Validar documentos da demanda
    public function validateDocuments(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aguardando_analise,aguardando_validacao_arquivos',
            'comment' => 'nullable|string',
        ]);

        $demand = Demand::findOrFail($id);
        $demand->update(['status' => $request->status]);

        if ($request->comment) {
            $demand->interactions()->create([
                'user_id' => $request->user()->id,
                'message' => $request->comment,
                'status' => $request->status,
            ]);
        }

        return response()->json(['message' => 'Status da demanda atualizado com sucesso'], 200);
    }
}