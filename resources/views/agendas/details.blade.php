<div class="p-4 bg-white rounded shadow">
    <h2 class="text-lg font-semibold mb-2">Agenda Details</h2>
    <p><strong>Title:</strong> {{ $agenda->title }}</p>
    <p><strong>Date:</strong> {{ $agenda->date }}</p>
    <p><strong>Notes:</strong> {{ $agenda->notes ?? 'No notes added.' }}</p>
</div>
