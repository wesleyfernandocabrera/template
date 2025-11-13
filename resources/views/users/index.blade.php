<x-app-layout>
    <!-- Page Title Starts -->
  
    <x-page-title page="Lista de Usuários" header="Lista de Usuários" />

    @section('title', 'Lista de usuários | Inusittá')

    <!-- Page Title Ends -->


    <!-- User List Starts -->
    <div class="space-y-4">
      <!-- User Header Starts -->
      <div class="flex flex-col items-center justify-between gap-y-4 md:flex-row md:gap-y-0">
        <!-- User Search Starts -->
        <form method="GET" action="{{ route('users.index') }}" class="group flex h-10 w-full items-center rounded-primary border border-transparent bg-white shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-inset focus-within:ring-primary-500 dark:border-transparent dark:bg-slate-800 dark:focus-within:border-primary-500 md:w-72"
        >
          <div class="flex h-full items-center px-2">
            <i class="h-4 text-slate-400 group-focus-within:text-primary-500" data-feather="search"></i>
          </div>
          <input
              name="search"
              class="h-full w-full border-transparent bg-transparent px-0 text-sm placeholder-slate-400 placeholder:text-sm focus:border-transparent focus:outline-none focus:ring-0"
              type="text"
              value="{{ request()->input('search') }}"
              placeholder="Buscar..."/>
        </form>
        <!-- User Search Ends -->

        <!-- User Action Starts -->
        <div class="flex w-full items-center justify-between gap-x-4 md:w-auto">
          <div class="flex items-center gap-x-4">
            <div class="dropdown" data-placement="bottom-end">
              <div class="dropdown-toggle">
                <button type="button" class="btn bg-white font-medium shadow-sm dark:bg-slate-800">
                  <i class="w-4 h-4" data-feather="filter"></i>
                  <span class="hidden sm:inline-block">Filtros</span>
                  <i class="w-4 h-4" data-feather="chevron-down"></i>
                </button>
              </div>
              <div class="dropdown-content w-72 !overflow-visible">
                <ul class="dropdown-list space-y-4 p-4">
                  <li class="dropdown-list-item">
                    <h2 class="my-1 text-sm font-medium">Setor</h2>
                    <select class="tom-select w-full" autocomplete="off">
                      <option value="">Selecione um setor</option>
                      <option value="1">Tecnologia</option>
                      <option value="2">Qualidade</option>
                      <option value="3">Processos</option>
                    </select>
                  </li>

                  <li class="dropdown-list-item">
                    <h2 class="my-1 text-sm font-medium">Status</h2>
                    <select class="tom-select w-full" autocomplete="off">
                      <option value="">Selecione um status</option>
                      <option value="1">Ativo</option>
                      <option value="2">Inativo</option>
                    </select>
                  </li>
                </ul>
              </div>
            </div>
<!-- Export CSV -->
<a href="{{ route('users.export.csv') }}" class="btn bg-white font-medium shadow-sm dark:bg-slate-800">
    <i class="h-4" data-feather="upload"></i>
    <span class="hidden sm:inline-block">Exportar CSV</span>
</a>

<!-- Export PDF -->
<a href="{{ route('users.export.pdf') }}" class="btn bg-white font-medium shadow-sm dark:bg-slate-800">
    <i class="h-4" data-feather="upload"></i>
    <span class="hidden sm:inline-block">Exportar PDF</span>
</a>


        @csrf
 
    <a class="btn btn-danger hidden" id="edit-user-button" href="#" role="button">
        <i data-feather="edit" height="1rem" width="1rem"></i>
        <span class="hidden sm:inline-block">Editar</span>
    </a>

          </form>

          </div>
   
          <a class="btn btn-primary" href="{{ route('users.create') }}" role="button">
            <i data-feather="plus" height="1rem" width="1rem"></i>
            <span class="hidden sm:inline-block">Criar</span>

          </a>
        </div>
        <!-- User Action Ends -->
      </div>
      <!-- User Header Ends -->

      <!-- User Table Starts -->
      <div class="table-responsive whitespace-nowrap rounded-primary">
        <table class="table">
          <thead>
            <tr>
              <th class="w-[5%]">
                <input class="checkbox" type="checkbox" data-check-all data-check-all-target=".user-checkbox" />

              </th>
              <th class="w-[30%] uppercase">Nome</th>
              <th class="w-[20%] uppercase">Email</th>
              <th class="w-[15%] uppercase">Setor</th>
              <th class="w-[15%] uppercase">Empresa</th>
              <th class="w-[15%] uppercase">Data de Criação</th>
              <th class="w-[15%] uppercase">Status</th>
            
              <th class="w-[5%] !text-right uppercase">Acão</th>
  
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>
                <script>
    window.usersEditBaseUrl = "{{ url('users') }}";
</script>
                <input class="checkbox user-checkbox" type="checkbox" value="{{ $user->id }}" />
              </td>
              <td>
                <div class="flex items-center gap-3">
                  <div class="avatar avatar-circle">
                    <img class="avatar-img" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/avatar1.png') }}" 
                alt="{{ $user->name }}" />
                  </div>
                  <div>
                    <h6 class="whitespace-nowrap text-sm font-medium text-slate-700 dark:text-slate-100">
                      {{ $user->name }}
                    </h6>
                    @if($user->positions && $user->positions->isNotEmpty())
                      <p class="truncate text-xs text-slate-500 dark:text-slate-400">
                     {{ $user->positions->pluck('name')->join(', ') }}
                      </p>
                     @else
                    <p class="truncate text-xs text-slate-400 italic">Sem cargo atribuído</p>
                    @endif
                  </div>
                </div>
              </td>
              <td>{{ $user->email }}</td>
              <td>
                  <span class="badge badge-soft-info">

              </td>

              <td>#</td>
              <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
              <td>@if($user->status)<div class="badge badge-soft-success">Ativo</div> @else <div class="badge badge-soft-danger">Inativo</div> @endif </td>

              <td>
                <div class="flex justify-end">
                  <div class="dropdown" data-placement="bottom-start">
                    <div class="dropdown-toggle">
                      <i class="w-6 text-slate-400" data-feather="more-horizontal"></i>
                    </div>
     
                    <div class="dropdown-content">
  <ul class="dropdown-list">
    <li class="dropdown-list-item">

    <a href="{{ route('users.edit', $user->id) }}" class="dropdown-link">
        <i class="h-5 text-slate-400" data-feather="external-link"></i>
        <span>Editar</span>

      </a>
    </li>

    <li class="dropdown-list-item">
      <a href="javascript:void(0)"
         class="dropdown-link"
         data-toggle="modal"
         data-target="#deleteModal-{{ $user->id }}">
        <i class="h-5 text-slate-400" data-feather="trash"></i>
        <span>Excluir</span>
      </a>
    </li>

  </ul>
</div>


<!-- Modal de Confirmação de Exclusão -->
<div class="modal modal-centered" id="deleteModal-{{ $user->id }}">
  <div class="modal-dialog modal-dialog-centered"> <!-- Centralizando o modal -->
      <div class="modal-content">
          <div class="modal-header">
              <div class="flex items-center justify-between">
                  <h6>Confirmação</h6>
                  <button type="button" class="btn btn-plain-secondary" data-dismiss="modal">
                      <i data-feather="x" width="1.5rem" height="1.5rem"></i>
                  </button>
              </div>
          </div>
          <div class="modal-body">
              <p class="text-sm text-slate-500 dark:text-slate-300">
                  Tem certeza que deseja excluir <strong>{{ $user->name }}</strong>?
              </p>
          </div>
          <div class="modal-footer flex justify-center">
              <!-- Centralizando os botões -->
              <div class="flex items-center justify-center gap-4">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <form method="POST" action="{{ route('users.destroy', $user) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Sim, excluir</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>




                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          
        </table>
      </div>
      <!-- User Table Ends -->

      <!-- User Pagination Starts -->
<div class="flex flex-col items-center justify-between gap-y-4 md:flex-row">
  <p class="text-xs font-normal text-slate-400">
    Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} resultados
  </p>
  {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}
</div>
<!-- User Pagination Ends -->
    </div>
    <!-- User List Ends -->
</x-app-layout>
