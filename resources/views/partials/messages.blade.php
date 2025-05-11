@if ($errors->any())
    <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 border border-red-200 rounded">
        <ul class="pl-5 space-y-1 list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 border border-green-200 rounded">
        {{ session('success') }}
    </div>
@endif
