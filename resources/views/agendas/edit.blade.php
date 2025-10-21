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
                <div class="p-8 max-w-4xl mx-auto">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">Edit Agenda</h1>
                        <a href="{{ route('agendas.show', $agenda->agenda_id) }}"
                            class="bg-amber-500 text-black px-4 py-2 rounded-lg hover:bg-amber-600 transition">
                            ← Back to View
                        </a>
                    </div>

                    {{-- Edit Form --}}
                    <form action="{{ route('agendas.update', $agenda->agenda_id) }}" method="POST" enctype="multipart/form-data"
                        class="bg-white shadow rounded-2xl p-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-6">
                            {{-- Title --}}
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-medium mb-2">Title</label>
                                <input type="text" name="title" value="{{ old('title', $agenda->title) }}"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-amber-500 focus:border-amber-500"
                                    required>
                            </div>

                            {{-- Date (readonly) --}}
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Date</label>
                                <input type="text" value="{{ \Carbon\Carbon::parse($agenda->date)->format('F d, Y') }}"
                                    class="w-full border border-gray-200 rounded-lg p-2.5 bg-gray-100 text-gray-600 cursor-not-allowed"
                                    readonly>
                            </div>

                            {{-- Status (readonly) --}}
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Status</label>
                                <input type="text" value="{{ ucfirst($agenda->status) }}"
                                    class="w-full border border-gray-200 rounded-lg p-2.5 bg-gray-100 text-gray-600 cursor-not-allowed"
                                    readonly>
                            </div>

                            {{-- Notes --}}
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-medium mb-2">Notes</label>
                                <textarea name="notes" rows="4"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-amber-500 focus:border-amber-500">{{ old('notes', $agenda->notes) }}</textarea>
                            </div>

                            {{-- File --}}
                            <div class="col-span-2">
                                <label class="block text-gray-700 font-medium mb-2">Replace File (Optional)</label>
                                <input type="file" name="file_path"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-amber-500 focus:border-amber-500">
                                @if($agenda->file_path)
                                    <p class="text-sm text-gray-600 mt-2">
                                        Current file:
                                        <a href="{{ asset('storage/' . $agenda->file_path) }}"
                                            target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                            {{ basename($agenda->file_path) }}
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex justify-end gap-4 mt-6">
                            <a href="{{ route('agendas.show', $agenda->agenda_id) }}"
                                class="bg-gray-300 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="bg-amber-500 text-black px-6 py-2 rounded-lg hover:bg-amber-600 transition">
                                Update Agenda
                            </button>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
</body>
</html>
