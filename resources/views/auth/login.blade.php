<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <title>Tela de Login | Inusittá</title>
    <meta
      name="description"
      content="Admin Toolkit is a modern admin dashboard template based on Tailwindcss. It comes with a variety of useful ui components and pre-built pages"
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
      <!-- Main Content Starts -->
      <main class="container flex-grow p-4 sm:p-6">
        <div class="card mx-auto w-full max-w-md">
          <div class="card-body px-10 py-12">
            <div class="flex flex-col items-center justify-center">
                <x-application-logo class=" fill-current text-gray-500" />
                <h5 class="mt-4">Login</h5>
              <p class="text-sm text-slate-500 dark:text-slate-400">Olá Bem vindo</p>
            </div>

            <div class="mt-6 flex flex-col gap-5">
              <!-- Email -->
              <form method="POST" action="{{ route('login') }}">
              @csrf
              <div>
                <label name="name"  class="label mb-1">E-mail</label>
                <input name="email" type="email" class="input" placeholder="Digite seu e-mail" value="{{ old('email')}}"/>
              
               <!-- Exibe a mensagem de erro se houver erro de validação -->
               @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror 
              
              </div>
              
              <!-- Password-->
              <div class="">
                <label class="label mb-1">Senha</label>
                <input name="password" type="password" class="input" placeholder="Senha" />
                
                <!-- Exibe a mensagem de erro se houver erro de validação -->
              @error('password')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
              </div>
            </div>
            <!-- Remember & Forgot-->
            <div class="mt-2 flex items-center justify-between">
              <div class="flex items-center gap-1.5">
                <input
                  type="checkbox"
                  class="h-4 w-4 rounded border-slate-300 bg-transparent text-primary-500 shadow-sm transition-all duration-150 checked:hover:shadow-none focus:ring-0 focus:ring-offset-0 enabled:hover:shadow disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-600"
                  id="remember-me"
                />
                <label for="remember-me" class="label">Lembrar-me</label>
              </div>
              <a href="{{route('password.request')}}" class="text-sm text-primary-500 hover:underline">Esqueceu sua senha</a>
            </div>
            <!-- Login Button -->
            <div class="mt-8">
              <button class="btn btn-primary w-full py-2.5">Entrar</button>
              <div class="relative mt-4 flex h-6 items-center justify-center py-4">
                <div class="h-[1px] w-full bg-slate-200 dark:bg-slate-600"></div>
                <div class="t absolute w-10 bg-white text-center text-xs text-slate-400 dark:bg-slate-800">Ou</div>
              </div>
            </div>
            <!-- Don't Have An Account -->
            <div class="mt-4 flex justify-center">
              <p class="text-sm text-slate-600 dark:text-slate-300">
                Não tem uma conta?
                <a href="{{ route('register') }}" class="text-sm text-primary-500 hover:underline">Inscrever-se</a>
              </p>
            </div>
          </div>
        </div>
      </main>
      <!-- Main Content Ends -->
    </div>
  </body>
</html>
