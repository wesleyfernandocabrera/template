<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <title>Recuperar senha | Inusittá</title>
    <meta
      name="description"
      content="Admin Toolkit is a modern admin dashboard template based on Tailwindcss. It comes with a variety of useful ui components and pre-built pages"/>
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
                <h5 class="mt-4">Recupere sua senha</h5>
            </div>

            <div class="mt-6 flex flex-col gap-5">
              <!-- Email -->
              <div>
              <form method="POST" action="{{ route('password.email') }}">
              @csrf
                <label name="name"  class="label mb-1">E-mail</label>
                <input name="email" type="text" class="input" placeholder="Digite seu e-mail" />

                @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror 

              </div>
              <!-- Recover Password -->
              <div class="mt-2">
                <button class="btn btn-primary w-full py-2.5">Recuperar senha</button>
              </div>
              <!-- Go back & login -->
              <div class="flex justify-center">
                <p class="text-sm text-slate-600 dark:text-slate-300">
                Voltar para <a href="{{ route('login') }}" class="text-sm text-primary-500 hover:underline">Login</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- Main Content Ends -->
    </div>
  </body>
</html>
