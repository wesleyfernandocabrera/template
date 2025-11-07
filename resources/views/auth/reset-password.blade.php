<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <title>Redefinir Senha | Inusittá</title>
    <meta
      name="description"
      content="Admin Toolkit - Redefinir senha"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

   @if(session('status'))
<div id="toast" class="fixed top-0 right-0 m-4 p-4 bg-green-500 text-white rounded shadow-lg z-50" role="alert">
    <p>{{ session('status') }}</p>
</div>
@endif
    
    <script>
      if (
        localStorage.getItem('theme') === 'dark' ||
        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
      ) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    </script>
  </head>

  <body>
    <div id="app" class="flex min-h-screen w-full items-center justify-center">
      <main class="container flex-grow p-4 sm:p-6">
        <div class="card mx-auto w-full max-w-md">
          <div class="card-body px-10 py-12">
            <div class="flex flex-col items-center justify-center">
              <x-application-logo class="fill-current text-gray-500" />
              <h5 class="mt-4">Redefinir sua senha</h5>
            </div>

            <!-- Mensagens de erro -->
            @if ($errors->any())
              <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                <ul class="list-disc pl-5 space-y-1">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Formulário -->
            <form method="POST" action="{{ route('password.update') }}" class="mt-6 flex flex-col gap-5">
              @csrf

              <input type="hidden" name="token" value="{{ request()->route('token') }}">
              <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

              <!-- Nova senha -->
              <div>
                <label class="label mb-1">Senha</label>
                <input name="password" type="password" required autocomplete="new-password" class="input" placeholder="Digite sua nova senha" />
              </div>

              <!-- Confirmação -->
              <div>
                <label class="label mb-1">Confirme a senha</label>
                <input name="password_confirmation" type="password" required autocomplete="new-password" class="input" placeholder="Confirme sua nova senha" />
              </div>

              <!-- Botão -->
              <div class="mt-2">
                <button type="submit" class="btn btn-primary w-full py-2.5">Redefinir</button>
              </div>
            </form>

            <!-- Voltar -->
            <div class="flex justify-center mt-4">
              <p class="text-sm text-slate-600 dark:text-slate-300">
                Voltar para <a href="{{ route('login') }}" class="text-sm text-primary-500 hover:underline">Login</a>
              </p>
            </div>

          </div>
        </div>
      </main>
    </div>
  </body>
</html>
