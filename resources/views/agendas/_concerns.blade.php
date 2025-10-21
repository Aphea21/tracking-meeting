<div class="bg-white shadow rounded-lg p-4 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Concerns / Issues</h2>
        <a href="{{ route('concerns.create', $agenda->agenda_id) }}" class="bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600">
            + Add Concern
        </a>
    </div>

    @if($concerns->isEmpty())
        <p class="text-gray-500">No concerns yet for this agenda.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Responsible</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Due Date</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($concerns as $concern)
                    <tr>
                        <td class="border px-4 py-2">{{ $concern->description }}</td>
                        <td class="border px-4 py-2">{{ $concern->responsible_person }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($concern->status) }}</td>
                        <td class="border px-4 py-2">
                            {{ $concern->due_date ? \Carbon\Carbon::parse($concern->due_date)->format('M d, Y') : '-' }}
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('concerns.edit', $concern->concern_id) }}" class="text-blue-600 hover:underline">Edit</a> |
                            <form action="{{ route('concerns.destroy', $concern->concern_id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Delete this concern?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
