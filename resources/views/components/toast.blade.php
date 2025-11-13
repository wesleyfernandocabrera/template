{{-- resources/views/components/toast.blade.php --}}
@if(session('toast_success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.toast.success(@json(session('toast_success')));
    });
</script>
@endif

@if(session('toast_danger'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.toast.danger(@json(session('toast_danger')));
    });
</script>
@endif

@if(session('toast_warning'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.toast.warning(@json(session('toast_warning')));
    });
</script>
@endif

@if(session('toast_info'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.toast.info(@json(session('toast_info')));
    });
</script>
@endif
