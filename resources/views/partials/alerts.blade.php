@if (session('success'))
    <div class="mb-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-300 flex items-center justify-between shadow-lg shadow-emerald-950/20">
        <div class="flex items-center gap-3">
            <span class="flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 rounded-2xl border border-rose-500/40 bg-rose-950/30 p-5 text-sm text-rose-200 shadow-lg shadow-rose-950/30">
        <div class="flex items-center gap-2 font-bold text-rose-400 mb-2">
            <span>Por favor corrige los siguientes errores antes de continuar:</span>
        </div>
        <ul class="list-disc list-inside space-y-1 text-rose-300/90">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif