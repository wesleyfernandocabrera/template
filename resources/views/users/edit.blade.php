<x-app-layout>
    <x-page-title page="Lista de Usuários" pageUrl="{{ route('users.index') }}" header="Editar Usuário" />

    @if(session('success'))
        <div id="toast" class="fixed top-0 right-0 m-4 p-4 bg-green-500 text-white rounded shadow-lg z-50" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

     @section('title', 'Editar usuário | Inusittá')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
        <!-- Coluna Esquerda - Avatar -->
        <section class="col-span-1 flex h-min w-full flex-col gap-6 lg:sticky lg:top-20">
            <div class="card">

                <form method="POST" action="{{ route('users.update.avatar', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                <div class="card-body flex flex-col items-center">
                    <div class="relative my-2 h-24 w-24 rounded-full">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/avatar11.png') }}"
                             alt="avatar-img" id="user-image-preview"
                             class="h-full w-full rounded-full object-cover" />
                        <label for="upload-avatar"
                               class="absolute bottom-0 right-0 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-slate-50 p-2 dark:bg-slate-900">
                            <span class="text-slate-600 dark:text-slate-300">
                                <i class="w-full" data-feather="camera"></i>
                            </span>
                            <input type="file" name="avatar" accept="image/*"
                                   class="hidden" id="upload-avatar" />
                        </label>
                    </div>
                    <button type="submit">
                    <h2 class="text-[16px] font-medium text-slate-700 dark:text-slate-200">Salvar foto</h2>
                    </button>
                    
                  </form>
                   
                </div>
            </div>
        </section>

        <!-- Coluna Direita - Formulários -->
        <section class="col-span-1 flex w-full flex-1 flex-col gap-6 lg:col-span-3 lg:w-auto">
            <!-- Detalhes Pessoais -->
            <div class="card">
                <div class="card-body">
                    <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Detalhes Pessoais</h2>
                    <p class="mb-4 text-sm font-normal text-slate-400">Atualize as informações do usuário</p>

                    <form method="POST"
                          action="{{ route('users.update.profile', $user->id) }}"
                          enctype="multipart/form-data"
                          class="flex flex-col gap-5">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <label class="label">
                                <span class="my-1 block">Nome</span>
                                <input type="text" name="name" class="input @error('name') border-red-500 @enderror"
                                       value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </label>

                            <label class="label">
                                <span class="my-1 block">Email</span>
                                <input type="email" name="email" class="input @error('email') border-red-500 @enderror"
                                       value="{{ old('email', $user->email) }}" />
                                @error('email')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </label>

                          <!-- Tipo -->
                        <label class="label">
                            <span class="my-1 block">Tipo</span>
                            <input type="text" name="type" maxlength="1" class="input @error('type') border-red-500 @enderror"
                                value="{{ old('type', $user->type) }}" />
                            @error('type')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        <!-- Matrícula -->
                        <label class="label">
                            <span class="my-1 block">Matrícula</span>
                            <input type="text" name="registration" class="input @error('registration') border-red-500 @enderror"
                                value="{{ old('registration', $user->registration) }}" />
                            @error('registration')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                        
                        <!-- Ramal -->
                        <label class="label">
                            <span class="my-1 block">Ramal</span>
                            <input type="text" name="corporate_phone" class="input @error('corporate_phone') border-red-500 @enderror"
                                value="{{ old('corporate_phone', $user->corporate_phone) }}" />
                            @error('corporate_phone')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        <!-- Admissão -->
                        <label class="label">
                            <span class="my-1 block">Admissão</span>
                            <input
                        id="admission"
                        name="admission"
                        type="text"
                        placeholder="DD-MM-AAAA"
                        class="input input-date bg-white dark:bg-slate-800 @error('admission') border-red-500 @enderror"
                        value="{{ old('admission', $user->admission ? $user->admission->format('d-m-Y') : '') }}"/>

                            @error('admission')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                        </div>
                                                
                        <div class="flex items-center justify-end gap-4 mt-4">
                            <a href="{{ route('users.index') }}"
                               class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>

<!-- Change Password -->
<div class="card">
    <div class="card-body">
        <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Alterar a senha</h2>
        <p class="mb-4 text-sm font-normal text-slate-400">
            Proteja sua conta com uma senha forte e segura
        </p>
        <form method="POST" action="{{ route('user.password.update', $user->id ?? null) }}" class="flex flex-col gap-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <label class="label" for="password">
                    <span class="my-1 block">Senha</span>
                    <input type="password" name="password" id="password" class="input @error('password') border-red-500 @enderror" />
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </label>

                <label class="label" for="password_confirmation">
                    <span class="my-1 block">Confirmar Senha</span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input" />
                </label>
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-end gap-4">
                <a href="{{ url()->previous() }}"
                    class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
</div>


            <!-- Atualizar Status -->
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update.status', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="0">

                        <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Ativar Usuário</h2>
                        <p class="text-sm font-normal text-slate-400">Defina se este usuário estará ativo no sistema.</p>

                        <label for="status" class="toggle my-2 flex items-center justify-between">
                            <div class="label">
                                <p class="text-sm font-normal text-slate-400">Ativar este usuário</p>
                            </div>
                            <div class="relative">
                                <input
                                    class="toggle-input peer sr-only"
                                    id="status"
                                    type="checkbox"
                                    name="status"
                                    value="1"
                                    {{ old('status', $user->status) == 1 ? 'checked' : '' }}>
                                <div class="toggle-body"></div>
                            </div>
                        </label>

                        @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('users.index') }}"
                               class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Vincular Permissões -->
            <div class="card">
    <div class="card-body">
        <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Vincular Menus</h2>
        <p class="mb-4 text-sm font-normal text-slate-400">Defina quais menus este usuário pode acessar</p>

        <form method="POST" action="{{ route('users.update.menus', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($menus as $menu)
                    <div class="flex items-center gap-1.5">
                        <input id="menu-{{ $menu->id }}"
                               class="checkbox checkbox-primary"
                               type="checkbox"
                               name="menus[]"
                               value="{{ $menu->id }}"
                               {{ $user->menus->contains($menu->id) ? 'checked' : '' }} />
                        <label for="menu-{{ $menu->id }}" class="label">
                            {{ ucfirst($menu->name) }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end gap-4 mt-4">
                <a href="{{ route('users.index') }}"
                   class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
</div>

            <!-- Vincular Papéis (Roles) -->
<!-- Vincular Papéis (Roles) -->
<div class="card">
    <div class="card-body">
        <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Vincular Papéis</h2>
        <p class="mb-4 text-sm font-normal text-slate-400">Defina os papéis (roles) que este usuário pode assumir</p>

        <form method="POST" action="{{ route('users.update.roles', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($roles as $role)
                    <div class="flex items-center gap-2">
                        <input id="role-{{ $role->id }}"
                               class="checkbox checkbox-primary"
                               type="checkbox"
                               name="roles[]"
                               value="{{ $role->id }}"
                               {{ $user->roles->contains($role->id) ? 'checked' : '' }} />
                        <label for="role-{{ $role->id }}" class="label flex items-center gap-2 cursor-pointer">
                            <span>{{ $role->name }}</span>
                            <span class="text-xs text-slate-400 dark:text-slate-500 italic">[{{ $role->module }}]</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end gap-4 mt-4">
                <a href="{{ route('users.index') }}"
                   class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
</div>

        </section>
    </div>
</x-app-layout>
