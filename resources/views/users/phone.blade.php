<x-app-layout>
    <x-page-title page="Lista de Ramais" header="Lista de Ramais" />
    @section('title', 'Lista de ramais | Inusittá')

    @if(session('status'))
    <div id="toast" class="fixed top-0 right-0 m-4 p-4 bg-green-500 text-white rounded shadow-lg z-50" role="alert">
      <p>{{ session('status') }}</p>
    </div>
    @endif

    <div class="space-y-4">
      <!-- Header -->
      <div class="flex flex-col items-center justify-between gap-y-4 md:flex-row md:gap-y-0">
        <form method="GET" action="{{ route('users.phones') }}" class="group flex h-10 w-full items-center rounded-primary border border-transparent bg-white shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-inset focus-within:ring-primary-500 md:w-72">
          <div class="flex h-full items-center px-2">
            <i class="h-4 text-slate-400 group-focus-within:text-primary-500" data-feather="search"></i>
          </div>
          <input
            name="search"
            class="h-full w-full border-transparent bg-transparent px-0 text-sm placeholder-slate-400 focus:border-transparent focus:outline-none focus:ring-0"
            type="text"
            value="{{ request()->input('search') }}"
            placeholder="Buscar por nome ou email..."/>
        </form>

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
                    <select name="sector" class="tom-select w-full">
                      <option value="">Todos</option>
                      @foreach($sectors as $sector)
                      <option value="{{ $sector->id }}" @selected(request()->input('sector') == $sector->id)>{{ $sector->name }}</option>
                      @endforeach
                    </select>
                  </li>
                  <li class="dropdown-list-item">
                    <h2 class="my-1 text-sm font-medium">Status</h2>
                    <select name="status" class="tom-select w-full">
                      <option value="">Todos</option>
                      <option value="1" @selected(request()->input('status') == '1')>Ativo</option>
                      <option value="0" @selected(request()->input('status') == '0')>Inativo</option>
                    </select>
                  </li>
                  <li class="dropdown-list-item pt-2">
                    <button type="submit" class="btn btn-primary w-full">Aplicar Filtros</button>
                  </li>
                </ul>
              </div>
            </div>

            <a href="{{ route('users.export.csv') }}" class="btn bg-white font-medium shadow-sm dark:bg-slate-800">
              <i class="h-4" data-feather="upload"></i>
              <span class="hidden sm:inline-block">Exportar CSV</span>
            </a>
            <a href="{{ route('users.export.pdf') }}" class="btn bg-white font-medium shadow-sm dark:bg-slate-800">
              <i class="h-4" data-feather="upload"></i>
              <span class="hidden sm:inline-block">Exportar PDF</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Tabela -->
      <div class="table-responsive whitespace-nowrap rounded-primary">
        <table class="table">
          <thead>
            <tr>
              <th class="w-[30%] uppercase">Nome</th>
              <th class="w-[25%] uppercase">Email</th>
              <th class="w-[25%] uppercase">Setor</th>
              <th class="w-[20%] uppercase">Ramal</th>
              <th class="w-[20%] uppercase">Ações</th>
            </tr>
          </thead>
<tbody>
  @forelse($users as $user)
  @php
      $userSectors = $user->sectors;
      $totalSectors = \App\Models\Sector::count();
      $sectorNames = $userSectors->pluck('name')->toArray();
      $tooltipContent = implode(', ', $sectorNames);
  @endphp
  <tr>
    <!-- Nome -->
    <td class="text-slate-700 dark:text-slate-100">{{ $user->name }}</td>

    <td class="text-slate-700 dark:text-slate-100">
  <div class="flex items-center gap-1">
    <i data-feather="mail" class="w-4 h-4 text-blue-500"></i>
    {{ $user->email }}
  </div>
</td>

    <!-- Setores -->
    <td>
      @if($userSectors->isEmpty())
        <span class="badge badge-soft-danger">Nenhum setor</span>
      @elseif($userSectors->count() === 1)
        <span class="badge badge-soft-info">{{ $userSectors->first()->name }}</span>
      @else
        <button
          type="button"
          class="badge badge-soft-secondary"
          data-tooltip="tippy"
          data-tippy-content="{{ $tooltipContent }}"
        >
          {{ $userSectors->count() === $totalSectors ? 'Todos' : $userSectors->count().' setores' }}
        </button>
      @endif
    </td>

    <td class="text-slate-700 dark:text-slate-100">
  <div class="flex items-center gap-1">
    <i data-feather="phone" class="w-4 h-4 text-green-500"></i>
    {{ $user->corporate_phone ?? '-' }}
  </div>
  </td>

    <!-- Ações -->
    <td>
      <div class="flex justify-end">
        <div class="dropdown" data-placement="bottom-start">
          <div class="dropdown-toggle cursor-pointer" tabindex="0">
            <i class="w-6 text-slate-400" data-feather="more-horizontal"></i>
          </div>
          <div class="dropdown-content">
            <ul class="dropdown-list">
              <li class="dropdown-list-item">

              </li>
            <li class="dropdown-list-item">
              <button type="button" class="dropdown-link flex items-center gap-2"
                onclick="copyEmail('{{ $user->email }}')">
                <i class="h-5 text-slate-400" data-feather="copy"></i>
                <span>Copiar Email</span>
              </button>
            </li>
              @if($user->corporate_phone)
              <li class="dropdown-list-item">
                <a href="tel:{{ $user->corporate_phone }}" class="dropdown-link">
                  <i class="h-5 text-slate-400" data-feather="phone"></i>
                  <span>Ligar ({{ $user->corporate_phone }})</span>
                </a>
              </li>
              @endif

            </ul>
          </div>
        </div>
      </div>
    </td>
  </tr>
  @empty
  <tr>
    <td colspan="5" class="text-center text-slate-500 py-4">Nenhum registro encontrado.</td>
  </tr>
  @endforelse
</tbody>

        </table>
      </div>

      <!-- Paginação -->
      <div class="flex flex-col items-center justify-between gap-y-4 md:flex-row">
        <p class="text-xs font-normal text-slate-400">
          Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} resultados
        </p>
        {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>

<!-- Toast Copiado -->
{{-- Toast Email Copiado --}}
<div id="copyToast" class="fixed top-4 right-4 m-4 p-4 bg-green-500 text-white rounded shadow-lg z-50 hidden" role="alert">
  <p>Email copiado com sucesso!</p>
</div>


<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .animate-fade-in {
    animation: fadeIn 0.2s ease-out;
  }
</style>


<script>
  function copyEmail(email) {
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(email).then(() => {
        showCopyToast();
      }).catch(err => {
        alert('Erro ao copiar email: ' + err);
      });
    } else {
      let textArea = document.createElement("textarea");
      textArea.value = email;
      textArea.style.position = "fixed";
      textArea.style.top = "-9999px";
      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();

      try {
        let successful = document.execCommand('copy');
        if (successful) {
          showCopyToast();
        } else {
          alert('Erro ao copiar email');
        }
      } catch (err) {
        alert('Erro ao copiar email: ' + err);
      }

      document.body.removeChild(textArea);
    }
  }

  function showCopyToast() {
    const toast = document.getElementById('copyToast');
    toast.classList.remove('hidden');

    setTimeout(() => {
      toast.classList.add('hidden');
    }, 3000); // desaparece após 3 segundos
  }
</script>



    
</x-app-layout>
