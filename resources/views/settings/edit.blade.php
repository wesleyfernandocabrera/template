<x-app-layout>
    <x-page-title page="Configurações" pageUrl="{{ route('settings.edit') }}" header="Editar Configurações" />

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
        <!-- Preview -->
        <section class="col-span-1 flex h-min w-full flex-col gap-6 lg:sticky lg:top-20">
            <div class="card">
                <div class="card-body flex flex-col items-center">
                    <div class="relative flex items-center justify-center h-24 w-24 rounded-full bg-slate-100 dark:bg-slate-700 p-4">
                        <i data-feather="settings" class="w-10 h-10 text-slate-600 dark:text-slate-200"></i>
                    </div>
                    <h2 class="mt-4 text-[16px] font-medium text-center text-slate-700 dark:text-slate-200">
                        Configurações do Sistema
                    </h2>
                </div>
            </div>
        </section>

        <!-- Formulário -->
        <section class="col-span-1 flex w-full flex-1 flex-col gap-6 lg:col-span-3 lg:w-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-[16px] font-semibold text-slate-700 dark:text-slate-300">Informações do Sistema</h2>
                    <p class="mb-4 text-sm font-normal text-slate-400">
                        Edite abaixo os dados públicos e internos do sistema.
                    </p>

                    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="flex flex-col gap-6">
                        @csrf

                        {{-- SITE --}}
                        <label class="label">
                            <span class="block mb-1">Site</span>
                            <input
                                type="text"
                                name="site"
                                class="input @error('site') border-red-500 @enderror"
                                value="{{ old('site', $data->site) }}"
                                required
                            />
                            @error('site')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        {{-- NAME --}}
                        <label class="label">
                            <span class="block mb-1">Desenvolvido por</span>
                            <input
                                type="text"
                                name="name"
                                class="input @error('name') border-red-500 @enderror"
                                value="{{ old('name', $data->name) }}"
                                required
                            />
                            @error('name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        {{-- archive_name --}}
                        <label class="label">
                            <span class="block mb-1">Nome do Arquivo (Título)</span>
                            <input
                                type="text"
                                name="archive_name"
                                class="input @error('archive_name') border-red-500 @enderror"
                                value="{{ old('archive_name', $data->archive_name) }}"
                                required
                            />
                            @error('archive_name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        {{-- ARQUIVO --}}
                        <label class="label">
                            <span class="block mb-1">Arquivo PDF (Código de Conduta)</span>
                            <input
                                type="file"
                                name="archive"
                                class="input @error('archive') border-red-500 @enderror"
                            />
                            @error('archive')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror

                            @if ($data->archive)
                                <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">
                                    Arquivo atual:
                                    <a href="{{ asset('storage/' . $data->archive) }}"
                                       class="text-blue-600 underline"
                                       target="_blank">
                                        Abrir PDF
                                    </a>
                                </p>
                            @endif
                        </label>

                        <!-- Botões -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ url()->previous() }}"
                               class="btn border border-slate-300 text-slate-500 dark:border-slate-700 dark:text-slate-300">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Salvar Configurações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
