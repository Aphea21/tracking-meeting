<!DOCTYPE html>
<html lang="en">
@include('partials.head')


<body class="bg-gray-50">
    <!-- Fixed Layout -->
    <div class="flex h-screen">
        <!-- Sidebar - Full Height -->
        <!-- Full Height Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content Area with Header -->
        <div class="flex-1 flex flex-col overflow-hidden">
@include('layouts.header-admin')

            <!-- Main Content - Scrollable area -->
<main class="flex-1 overflow-y-auto bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Agendas</h1>
                          <a href="{{ route('agendas.archived') }}" class="inline-block mt-3 sm:mt-0 px-4 py-2 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition"">
    📦 View Archived Agendas
</a>     
<a href="{{ route('agendas.create') }}" 
               class="inline-block mt-3 sm:mt-0 px-4 py-2 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition">
                + New Agenda
            </a>
     
        </div>


        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Created By</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                    @forelse($agendas as $agenda)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 font-medium">{{ $agenda->title }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($agenda->date)->format('M d, Y') }}</td>
                            <td class="px-6 py-3">{{ $agenda->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-center space-x-3">
                                <a href="{{ route('agendas.show', $agenda->agenda_id) }}" 
                                   class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('agendas.edit', $agenda->agenda_id) }}" 
                                   class="text-amber-600 hover:underline">Edit</a>
                                <form action="{{ route('agendas.destroy', $agenda->agenda_id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" 
                                            onclick="return confirm('Archive this agenda?')">Archive</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No agendas found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

        </div>
    </div>


</body>

</html>
