@if ($errors->any())
    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
