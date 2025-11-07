<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <title>Criar uma conta | Inusittá</title>
    <meta
      name="description"
      content="Admin Toolkit is a modern admin dashboard template based on Tailwindcss. It comes with a variety of useful ui components and pre-built pages"
    />
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
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
                <h5 class="mt-4">Criar uma conta</h5>
            </div>

            <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mt-6 flex flex-col gap-5">
              <!-- Fullname -->
              <div>
              <label class="label mb-1">Nome Completo</label>

              <!-- Adicionando classes dinâmicas para quando houver erro -->
              <input name="name" type="text" 
              class="input @error('name') border-red-500 @enderror" 
              placeholder="Digite seu nome completo" value="{{ old('name')}}"/>

              <!-- Exibe a mensagem de erro se houver erro de validação -->
              @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
              </div>
              <!-- Email -->
              <div>
                <label class="label mb-1">Email</label>
                <input name="email" type="text" class="input" placeholder="Digite seu e-mail" value="{{ old('email')}}"/>
              
               <!-- Exibe a mensagem de erro se houver erro de validação -->
               @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror  
              </div>
              <!-- Password -->
              <div>
                <label class="label mb-1">Senha</label>
                <input name="password" type="password" class="input" placeholder="Senha " />
              </div>
              <!-- Exibe a mensagem de erro se houver erro de validação -->
              @error('password')
             <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
             @enderror  
               <!-- Password -->
               <div>
                <label class="label mb-1">Confirmar Senha</label>
                <input name="password_confirmation" type="password" class="input" placeholder="Senha " />
              </div>
            <!-- Login Button -->
      
            <div class="mt-8">
              <button class="btn btn-primary w-full py-2.5"><a href="{{ route('login') }}">Cadastrar</a></button>
              <div class="relative mt-4 flex h-6 items-center justify-center py-4">
                <div class="h-[1px] w-full bg-slate-200 dark:bg-slate-600"></div>
                <div class="t absolute w-10 bg-white text-center text-xs text-slate-400 dark:bg-slate-800">Ou</div>
              </div>
              </form>
            <!-- Don't Have An Account -->
            <div class="mt-4 flex justify-center">
              <p class="text-sm text-slate-600 dark:text-slate-300">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-sm text-primary-500 hover:underline">Entrar</a>
              </p>
            </div>
          </div>
        </div>
      </main>
      <!-- Main Content Ends -->
    </div>
  </body>
</html>
