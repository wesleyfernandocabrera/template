<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    // Listar menus
    public function index()
    {
        if (!in_array(auth()->id(), [1, 5])) {
    return redirect()->route('dashboard')->with('status', 'Acesso restrito. Apenas o administrador pode acessar este menu.');
    }

        $menus = Menu::paginate(10);
        return view('menu.index', compact('menus'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('menu.create');
    }

    // Salvar novo menu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Menu::create([
            'name' => $request->name,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu criado com sucesso!');
    }

    // Mostrar formulário de edição
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    // Atualizar menu existente
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $menu->update([
            'name' => $request->name,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu atualizado com sucesso!');
    }

    // Deletar menu
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu excluído com sucesso!');
    }
}
