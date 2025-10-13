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
            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Whatever</h1>
                    <a href="{{ route('agendas.create') }}" class="btn btn-primary">+ New Agenda</a>
                </div>
            
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th>Title</th>
                            <th>Date</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                            <tr>
                                <td>{{ $agenda->title }}</td>
                                <td>{{ $agenda->date }}</td>
                                <td>{{ $agenda->user->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('agendas.show', $agenda->agenda_id) }}" class="text-blue-600">View</a> |
                                    <a href="{{ route('agendas.edit', $agenda->agenda_id) }}" class="text-yellow-600">Edit</a> |
                                    <form action="{{ route('agendas.destroy', $agenda->agenda_id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600" onclick="return confirm('Archive this agenda?')">Archive</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

              
                </div>
            </main>
        </div>
    </div>


</body>

</html>
