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
                    <h1 class="text-2xl font-semibold text-gray-900">Create New Agenda</h1>

                    <form action="{{ route('agendas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label>Title</label>
                                <input type="text" name="title" class="input" required>
                            </div>
                
                            <div>
                                <label>Date</label>
                                <input type="date" name="date" class="input" required>
                            </div>
                
                            <div class="col-span-2">
                                <label>Notes</label>
                                <textarea name="notes" rows="4" class="input"></textarea>
                            </div>
                
                            <div class="col-span-2">
                                <label>File Attachment</label>
                                <input type="file" name="file_path" class="input">
                            </div>
                        </div>
                
                        <button type="submit" class="btn btn-primary mt-4">Save Agenda</button>
                    </form>

              
                </div>
            </main>
        </div>
    </div>


</body>

</html>

   
