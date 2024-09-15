<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PublisherController extends Controller
{
    // Função para exibir uma lista de editoras
    public function index()
    {
        $publishers = Publisher::with('books')->get();
        return view('publishers.index', compact('publishers'));
    }

    // Função para exibir uma editora específica
    public function show($id)
    {
        $publisher = Publisher::with('books')->findOrFail($id);
        return view('publishers.show', compact('publisher'));
    }

    public function create()
    {
        Gate::authorize('librarian', User::class);
        return view('publishers.create');
    }

    // Função para armazenar uma nova editora no banco de dados
    public function store(Request $request)
    {
        Gate::authorize('librarian', User::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Publisher::create($validatedData);

        return redirect()->route('publishers.index')->with('success', 'Editora criada com sucesso!');
    }

    // Função para exibir o formulário de edição de uma editora
    public function edit($id)
    {
        Gate::authorize('librarian', User::class);
        $publisher = Publisher::findOrFail($id);
        return view('publishers.edit', compact('publisher'));
    }

    // Função para atualizar uma editora no banco de dados
    public function update(Request $request, $id)
    {
        Gate::authorize('librarian', User::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $publisher = Publisher::findOrFail($id);
        $publisher->update($validatedData);

        return redirect()->route('publishers.index')->with('success', 'Editora atualizada com sucesso!');
    }

    // Função para excluir uma editora do banco de dados
    public function destroy($id)
    {
        Gate::authorize('librarian', User::class);
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return redirect()->route('publishers.index')->with('success', 'Editora excluída com sucesso!');
    }
}
