<x-app-layout>
    <!-- Page Title Starts -->
    <x-page-title page="Lista de Usuários" pageUrl="{{ route('users.index') }}" header="Criar Usuário" />
    <!-- Page Title Ends -->

    @section('title', 'Criar usuário | Inusittá')

    <!-- User Profile Start  -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
        <!-- Left Section Start  -->
        <section class="col-span-1 flex h-min w-full flex-col gap-6 lg:sticky lg:top-20">
            <!-- User Avatar -->
            <div class="card">
                <div class="card-body flex flex-col items-center">
                    <div class="relative my-2 h-24 w-24 rounded-full">
                        <img src="{{ asset('images/avatar11.png') }}" alt="avatar-img" id="user-image-preview"
                             class="h-full w-full rounded-full object-cover" />
                        <label for="upload-avatar"
                               class="absolute bottom-0 right-0 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-slate-50 p-2 dark:bg-slate-900">
                            <span class="text-slate-600 dark:text-slate-300">
                                <i class="w-full" data-feather="camera"></i>
                            </span>
                            <input type="file" name="avatar" accept="image/jpeg, image/png, image/jpg"
                                   class="hidden" id="upload-avatar" />
                        </label>
                    </div>
                    <h2 class="text-[16px] font-medium text-slate-700 dark:text-slate-200">Upload Imagem</h2>
                </div>
            </div>
        </section>
        <!-- Left Section End  -->

        <!-- Right Section Start  -->
        <section class="col-span-1 flex w-full flex-1 flex-col gap-6 lg:col-span-3 lg:w-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Detalhes Pessoais</h2>
                    <p class="mb-4 text-sm font-normal text-slate-400">Insira as informações do usuário</p>

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="flex flex-col gap-5">
                        @csrf

                        <!-- Name & Email -->
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <label class="label">
                                <span class="my-1 block">Nome</span>
                                <input type="text" name="name" class="input @error('name') border-red-500 @enderror"
                                       value="{{ old('name') }}" />
                                @error('name')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </label>

                            <label class="label">
                                <span class="my-1 block">Email</span>
                                <input type="email" name="email" class="input @error('email') border-red-500 @enderror"
                                       value="{{ old('email') }}" />
                                @error('email')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <label class="label">
                                <span class="my-1 block">Senha</span>
                                <input type="password" name="password" class="input @error('password') border-red-500 @enderror" />
                                @error('password')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </label>

                            <label class="label">
                                <span class="my-1 block">Confirmar Senha</span>
                                <input type="password" name="password_confirmation" class="input" />
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('users.index') }}"
                               class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Right Section End -->
    </div>
    <!-- User Profile End  -->

    <!-- Script para preview da imagem -->
    <script>
        document.getElementById('upload-avatar').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('user-image-preview').src = URL.createObjectURL(file);
            }
        });
    </script>
</x-app-layout>
