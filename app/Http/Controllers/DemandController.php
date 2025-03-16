<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\DemandDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DemandController extends Controller
{
    // Criar demanda
    public function createDemand(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'supplier_name' => 'required|string|max:255',
            'supplier_document' => 'required|string|max:18',
            'supplier_phone' => 'nullable|string|max:15',
            'supplier_email' => 'nullable|email|max:255',
            'identity_documents.*' => 'file|mimes:pdf,jpeg,png|max:20480',
            'address_documents.*' => 'file|mimes:pdf,jpeg,png|max:20480',
            'consumption_documents.*' => 'file|mimes:pdf,jpeg,png|max:20480',
        ]);

        $demand = Demand::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'supplier_name' => $request->supplier_name,
            'supplier_document' => $request->supplier_document,
            'supplier_phone' => $request->supplier_phone,
            'supplier_email' => $request->supplier_email,
            'status' => 'aguardando_validacao_arquivos',
        ]);

        $this->uploadDocuments($request, $demand);

        return response()->json(['message' => 'Demanda criada com sucesso', 'demand' => $demand], 201);
    }

    // Upload de documentos
    private function uploadDocuments(Request $request, Demand $demand)
    {
        $types = [
            'identity_documents' => 'identity',
            'address_documents' => 'address',
            'consumption_documents' => 'consumption',
        ];

        foreach ($types as $inputName => $type) {
            if ($request->hasFile($inputName)) {
                foreach ($request->file($inputName) as $file) {
                    $path = $file->store('demand_documents');
                    $demand->documents()->create([
                        'type' => $type,
                        'file_path' => $path,
                    ]);
                }
            }
        }
    }

    // Detalhar demanda
    public function showDemand($id)
    {
        $demand = Demand::with(['user', 'documents'])->findOrFail($id);
        return response()->json($demand);
    }

    // Adicionar interação
    public function addInteraction(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string',
            'files.*' => 'file|mimes:pdf,jpeg,png|max:20480',
        ]);

        $demand = Demand::findOrFail($id);

        $interaction = $demand->interactions()->create([
            'user_id' => $request->user()->id,
            'message' => $request->message,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('interaction_files');
                $interaction->files()->create(['file_path' => $path]);
            }
        }

        return response()->json(['message' => 'Interação adicionada com sucesso'], 201);
    }
}