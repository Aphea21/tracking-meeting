<div class="p-4 bg-white rounded shadow">
    <h2 class="text-lg font-semibold mb-2">Attachments</h2>
    @if($agenda->file_path)
        <a href="{{ asset('storage/'.$agenda->file_path) }}" target="_blank" class="text-blue-600">View Uploaded File</a>
    @else
        <p>No attachments uploaded.</p>
    @endif
</div>
