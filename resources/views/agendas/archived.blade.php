<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Section -->
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.header-admin')

            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="p-6 max-w-7xl mx-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-900">📦 Archived Agendas</h1>
                            <p class="text-sm text-gray-500">List of agendas that have been archived.</p>
                        </div>
                        <a href="{{ route('agendas.index') }}"
                            class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700">
                            ⬅ Back to Active Agendas
                        </a>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table -->
                    @if ($agendas->isEmpty())
                        <div class="text-center py-10 bg-white rounded-lg shadow-sm">
                            <p class="text-gray-600">No archived agendas found.</p>
                        </div>
                    @else
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <table class="min-w-full border border-gray-200">
                                <thead class="bg-gray-200 text-gray-700">
                                    <tr>
                                        <th class="text-left px-4 py-2">Title</th>
                                        <th class="text-left px-4 py-2">Notes</th>
                                        <th class="text-left px-4 py-2">Date Archived</th>
                                        <th class="text-center px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($agendas as $agenda)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 font-medium text-gray-900">{{ $agenda->title }}</td>
                                            <td class="px-4 py-2 text-gray-600">{{ $agenda->notes }}</td>
                                            <td class="px-4 py-2 text-gray-500">
                                                {{ $agenda->updated_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                <form action="{{ route('agendas.restore', $agenda->agenda_id) }}"
                                                    method="POST" onsubmit="return confirm('Restore this agenda?')"
                                                    class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                                        ♻️ Restore
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
