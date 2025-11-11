<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sector;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PDF;

class UserController extends Controller
{
    public function index(Request $request)
{
    
    $users = User::query();

    $users->when($request->input('search'), function ($query, $keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('email', 'like', '%' . $keyword . '%')
              ->orWhereHas('sectors', function ($q2) use ($keyword) {
                  $q2->where('name', 'like', '%' . $keyword . '%');
              });
        });
    });

    // Adiciona a ordenação alfabética por nome
    $users = $users->orderBy('name', 'asc')->paginate(10);

    return view('users.index', compact('users'));
}


    public function create()
    {
        //$sector = Sector::all();
        $roles = Role::all();
        //return view('users.create', compact('sector', 'roles'));
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($avatarPath = $this->handleAvatarUpload($request)) {
            $input['avatar'] = $avatarPath;
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route('users.index')->with('status', 'Usuário adicionado com sucesso.');
    }

    public function edit(User $user)
    {
        Gate::authorize('edit', User::class);

        $user->load('menus', 'roles');
        $sector = Sector::where('status', 1)->get();
        $menus = Menu::all();
        $roles = Role::all();

        return view('users.edit', compact('user', 'sector',  'menus', 'roles'));
    }

   

public function update(Request $request, User $user)
{
    $input = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8',
        'type' => 'nullable|string|max:1',
        'registration' => 'nullable|string|max:255',
        'admission' => 'nullable|string', // Altere para string pois virá como "27-07-2025"
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'status' => 'required|boolean',
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
    ]);

    // Converte a data para o formato aceito pelo banco (Y-m-d)
    if (!empty($input['admission'])) {
        try {
            $input['admission'] = Carbon::createFromFormat('d-m-Y', $input['admission'])->format('Y-m-d');
        } catch (\Exception $e) {
            // Se der erro, você pode invalidar manualmente:
            return back()->withErrors(['admission' => 'Data de admissão inválida.']);
        }
    }

    if ($request->filled('password')) {
        $input['password'] = Hash::make($request->password);
    } else {
        unset($input['password']);
    }

    if ($avatarPath = $this->handleAvatarUpload($request)) {
        $input['avatar'] = $avatarPath;
    }

    $user->update($input);

    if ($request->has('roles')) {
        $user->roles()->sync($request->roles);
    }

    return redirect()->route('users.edit', $user)->with('success', 'Usuário atualizado com sucesso.');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Usuário removido com sucesso.');
    }

    public function updatesector(Request $request, User $user)
    {
        $validated = $request->validate([
            'sector' => 'nullable|array',
            'sector.*' => 'exists:sector,id',
        ]);

        $user->sector()->sync($validated['sector'] ?? []);
        return redirect()->route('users.edit', $user)->with('success', 'Setores atualizados com sucesso.');
    }


    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $user->status = (int) $request->status;
        $user->save();

        return redirect()->route('users.edit', $user)->with('success', 'Status do usuário atualizado com sucesso!');
    }

    public function updateProfile(Request $request, User $user)
{
    $input = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'type' => 'nullable|string|max:1',
        'corporate_phone' => 'nullable|string|max:20',
        'registration' => 'nullable|string|max:255',
        'admission' => 'nullable|date',
    ]);

    if ($request->filled('password')) {
        $input['password'] = bcrypt($request->password);
    } else {
        unset($input['password']);
    }

    if ($avatarPath = $this->handleAvatarUpload($request)) {
        $input['avatar'] = $avatarPath;
    }

    // Atualiza os campos no usuário
    $user->update($input);

    return redirect()->route('users.edit', $user)->with('success', 'Usuário atualizado com sucesso.');
}


    public function updateRoles(Request $request, User $user)
    {
        $input = $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($input['roles'] ?? []);
        return redirect()->route('users.edit', $user)->with('success', 'Funções atualizadas com sucesso.');
    }

    public function updateMenus(Request $request, User $user)
    {
        $input = $request->validate([
            'menus' => 'nullable|array',
            'menus.*' => 'exists:menus,id',
        ]);

        $user->menus()->sync($input['menus'] ?? []);
        return redirect()->route('users.edit', $user->id)->with('success', 'Menus atualizados com sucesso!');
    }

    private function handleAvatarUpload(Request $request)
    {
        return $request->hasFile('avatar')
            ? $request->file('avatar')->store('images/profiles', 'public')
            : null;
    }
    public function updatePassword(Request $request, User $user)
{
    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
}
public function updateAvatar(Request $request, User $user)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($avatarPath = $this->handleAvatarUpload($request)) {
        $user->avatar = $avatarPath;
        $user->save();
    }

    return redirect()->back()->with('success', 'Avatar atualizado com sucesso!');
}
public function exportCsv()
    {
        $users = User::with('sectors', 'roles')->get();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');

            // Cabeçalho do CSV
            fputcsv($file, ['ID', 'Nome', 'Email', 'Setores', 'Funções', 'Status', 'Data de Criação']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->sectors->pluck('name')->implode(', '),
                    $user->roles->pluck('name')->implode(', '),
                    $user->status ? 'Ativo' : 'Inativo',
                    $user->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $users = User::with('sectors', 'roles')->get();

        $pdf = PDF::loadView('users.export-pdf', compact('users'));

        return $pdf->download('users.pdf');
    }
    public function phones(Request $request)
    {
        $query = User::query();

        // Filtro por busca
        if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('corporate_phone', 'like', '%' . $request->search . '%')
            ->orWhereHas('sectors', function ($q2) use ($request) {
                $q2->where('name', 'like', '%' . $request->search . '%');
            });
        });
        }

        // Filtro por setor
        if ($request->filled('sector')) {
            $query->whereHas('sectors', function ($q) use ($request) {
                $q->where('sectors.id', $request->sector);
            });
        }

    // Filtro por status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Só traz usuários que tenham ramal cadastrado
    $query->whereNotNull('corporate_phone')
          ->where('corporate_phone', '!=', '');

    // Carrega setores para os filtros e paginação
    $sectors = \App\Models\Sector::orderBy('name')->get();
    $users = $query->with('sectors')->orderBy('name')->paginate(12);

    return view('users.phone', compact('users', 'sectors'));
    }



}