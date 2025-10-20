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

                    <div class="container mx-auto">
                        <div class="mb-6">
                            <h1 class="text-3xl font-bold">{{ $agenda->title }}</h1>
                            <p class="text-gray-600">
                                {{ $agenda->date->format('F d, Y') }} | Created by: {{ $agenda->user->name ?? 'N/A' }}
                            </p>
                        </div>

                        {{-- Tabs Section --}}
                        <div x-data="{ tab: 'details' }">
                            <div class="flex border-b mb-4">
                                <button class="px-4 py-2" :class="{ 'border-b-2 border-amber-500': tab === 'details' }"
                                    @click="tab = 'details'">Details</button>
                                <button class="px-4 py-2" :class="{ 'border-b-2 border-amber-500': tab === 'concerns' }"
                                    @click="tab = 'concerns'">Concerns</button>
                                <button class="px-4 py-2"
                                    :class="{ 'border-b-2 border-amber-500': tab === 'attachments' }"
                                    @click="tab = 'attachments'">Attachments</button>
                                <button class="px-4 py-2" :class="{ 'border-b-2 border-amber-500': tab === 'comments' }"
                                    @click="tab = 'comments'">Comments</button>
                            </div>

                            {{-- Include partials dynamically --}}
                            {{-- <div x-show="tab === 'details'">@include('agendas._details')</div>
        <div x-show="tab === 'concerns'">@include('agendas._concerns')</div>
        <div x-show="tab === 'attachments'">@include('agendas._attachments')</div>
        <div x-show="tab === 'comments'">@include('agendas._comments')</div> --}}
                        </div>
                    </div>
