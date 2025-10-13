<div class="p-4 bg-white rounded shadow">
    <h2 class="text-lg font-semibold mb-2">Concerns</h2>
    @foreach($agenda->concerns as $concern)
        <div class="border-b py-2">
            <p><strong>{{ $concern->description }}</strong></p>
            <p>Status: <span class="text-amber-600">{{ ucfirst($concern->status) }}</span></p>
        </div>
    @endforeach
</div>
