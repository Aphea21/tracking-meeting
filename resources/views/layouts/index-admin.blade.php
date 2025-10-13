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
                    {{-- <div class="mt-4 p-6 bg-white rounded-lg shadow-md">
                        <p class="text-gray-600">Now the scrollbar only appears in this main content area!</p>
                    </div> --}}

              
                </div>
            </main>
        </div>
    </div>


</body>

</html>
