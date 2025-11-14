<footer class="footer">

    <p class="text-sm">
        Copyright © {{ now()->year }}

        <a class="text-slate-600 hover:underline"
           href="{{ $settings?->site ?? '#' }}"
           target="_blank">
            Desenvolvido por {{ $settings?->name ?? 'Sua Empresa' }}
        </a>
    </p>

    <a href="{{ $settings?->archive ? asset('storage/' . $settings->archive) : '#' }}"
       target="_blank"
       class="flex items-center gap-1 text-sm text-slate-600 hover:text-slate-800 transition">
        <i data-feather="loader" width="16" height="16"></i>
        <span>{{ $settings?->archive_name ?? 'Documento' }}</span>
    </a>

</footer>
