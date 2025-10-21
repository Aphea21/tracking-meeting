<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="bg-gray-50">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.header-admin')

            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="p-8 max-w-5xl mx-auto">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $agenda->title }}</h1>
                            <p class="text-gray-600 text-sm mt-1">
                                Date: <span class="font-medium">{{ \Carbon\Carbon::parse($agenda->date)->format('F d, Y') }}</span> <br>
                                Created by: <span class="font-medium">{{ $agenda->user->name ?? 'N/A' }}</span>
                            </p>
                        </div>

                        <a href="{{ route('agendas.index') }}"
                            class="bg-amber-500 text-black px-4 py-2 rounded-lg hover:bg-amber-600 transition">
                            ← Back to List
                        </a>
                    </div>

                    {{-- Details Section --}}
                    <div class="bg-white rounded-2xl shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-800">Agenda Details</h2>
                        <div class="border-t border-gray-200 mt-2 pt-3 text-gray-700">
                            <p class="mb-2"><strong>Title:</strong> {{ $agenda->title }}</p>
                            <p class="mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($agenda->date)->toFormattedDateString() }}</p>
                            <p class="mb-2"><strong>Status:</strong>
                                <span class="px-2 py-1 rounded text-sm
                                    @if($agenda->status === 'active') bg-green-100 text-green-700
                                    @elseif($agenda->status === 'archived') bg-gray-200 text-gray-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($agenda->status) }}
                                </span>
                            </p>
                            <p class="mb-4"><strong>Notes:</strong></p>
                            <p class="bg-gray-50 p-3 rounded-lg border border-gray-200 whitespace-pre-line">
                                {{ $agenda->notes ?: 'No notes available.' }}
                            </p>
                        </div>
                    </div>

                    {{-- File Attachment --}}
                    @if($agenda->file_path)
                        <div class="bg-white rounded-2xl shadow p-6 mb-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800">File Attachment</h2>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                                <p class="text-gray-700">{{ basename($agenda->file_path) }}</p>
                                <a href="{{ asset('storage/' . $agenda->file_path) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                    View / Download
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex gap-4 mt-8">
                        <a href="{{ route('agendas.edit', $agenda->agenda_id) }}"
                            class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <form action="{{ route('agendas.destroy', $agenda->agenda_id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to archive this agenda?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">
                                Archive
                            </button>
                        </form>
                    </div>

                    {{-- Include Concerns Section --}}
@include('agendas._concerns', ['concerns' => $agenda->concerns])
                </div>
            </main>
        </div>
    </div>
</body>
</html>
