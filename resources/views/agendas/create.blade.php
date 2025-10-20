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
               
<form action="{{ route('agendas.store') }}" method="POST" enctype="multipart/form-data" 
      class="max-w-2xl mx-auto bg-white shadow-md rounded-2xl p-6 border border-gray-200">
    @csrf

    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Add New Agenda</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" required
                class="w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500 text-gray-800">
        </div>

        <!-- Date (auto set to today) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="date" required
                value="{{ date('Y-m-d') }}"
                class="w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500 text-gray-800">
        </div>

        <!-- Notes -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea name="notes" rows="4"
                class="w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500 text-gray-800"></textarea>
        </div>

        <!-- File -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">File Attachment</label>
            <input type="file" name="file_path"
                class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-500 file:text-white hover:file:bg-amber-600">
        </div>
    </div>

    <!-- Button -->
    <div class="mt-6 flex justify-end">
        <button type="submit"
            class="px-5 py-2.5 bg-amber-500 text-white font-medium rounded-lg shadow hover:bg-amber-600 focus:ring-2 focus:ring-amber-400 focus:ring-offset-1 transition">
            Save Agenda
        </button>
    </div>
</form>


              
                </div>
            </main>
        </div>
    </div>


</body>

</html>

   
