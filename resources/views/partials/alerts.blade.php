@if (session('success'))
    <div class="mb-8 rounded-xl border border-emerald-500/30 bg-emerald-950/20 px-5 py-3.5 text-xs font-mono text-emerald-300 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
            <span>STATUS 200 — {{ session('success') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="mb-8 rounded-xl border border-rose-500/30 bg-rose-950/20 p-5 text-sm text-rose-200">
        <div class="font-mono text-xs uppercase tracking-widest text-rose-400 mb-2">
            [ERROR DE VALIDACIÓN — REVISA LOS CAMPOS]
        </div>
        <ul class="list-disc list-inside space-y-1 text-xs text-rose-300/90">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif