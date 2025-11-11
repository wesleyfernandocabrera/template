<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Usuários</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Lista de Usuários</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Setores</th>
                <th>Funções</th>
                <th>Status</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->sectors->pluck('name')->implode(', ') }}</td>
                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                <td>{{ $user->status ? 'Ativo' : 'Inativo' }}</td>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
