@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    <div class="flex items-center justify-between my-5">
        <h1 class="font-bold text-2xl">Inbox</h1>
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-reset flex">
                <li><a href="#" class="">Home</a></li>
                <li><span class="mx-2">></span></li>
                <li class="text-gray-700">Inbox</li>
            </ol>
        </nav>
    </div>
    <div class="flex gap-4">
        <!-- Sidebar -->
        <aside class="w-64 bg-white p-4 rounded-xl shadow">
            {{-- <button class="w-full bg-indigo-600 text-white py-2 rounded-xl mb-6 font-semibold">Compose</button> --}}
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">MAILBOX</h3>
                <ul class="space-y-2">
                    <li
                        class="flex justify-between items-center text-blue-600 font-medium bg-blue-100 px-2 py-2 rounded-lg">
                        <span class="flex items-center gap-2">
                            📥 Inbox
                        </span>
                        <span class="text-sm bg-indigo-100 text-indigo-600 rounded-full px-2">3</span>
                    </li>
                    {{-- <li class="text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        📤 Sent
                    </li> --}}
                    <li
                        class="flex justify-between text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        <span>🗑 Spam</span>
                        <span class="text-sm bg-gray-100 text-gray-600 rounded-full px-2">2</span>
                    </li>
                    <li class="text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        🗑 Trash
                    </li>
                    <li class="text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        📦 Archive
                    </li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">FILTER</h3>
                <ul class="space-y-2">
                    <li class="text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        ⭐ Starred
                    </li>
                    <li class="text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        📁 Work
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">LABEL</h3>
                <ul class="space-y-2">
                    <li
                        class="flex items-center gap-2 text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Feedback
                    </li>
                    <li
                        class="flex items-center gap-2 text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span> Bug
                    </li>
                    <li
                        class="flex items-center gap-2 text-gray-600 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Work
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Inbox -->
        <div class="flex-1 bg-white rounded-xl shadow p-4">
            <!-- Top actions -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <input type="checkbox" />
                    <button class="p-1 hover:bg-gray-100 rounded">🔄</button>
                    <button class="p-1 hover:bg-gray-100 rounded">🗑</button>
                    <button class="p-1 hover:bg-gray-100 rounded">⋮</button>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search..."
                        class="border border-gray-200 rounded-full pl-4 pr-10 py-1 text-sm" />
                    <span class="absolute right-2 top-1.5 text-gray-400">🔍</span>
                </div>
            </div>

            {{-- <div>Total Pesan: 500</div> --}}
            <!-- Footer pagination -->
            <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                <span>Showing 1 of 159</span>
                <div class="flex gap-2">
                    <button class="p-1 rounded hover:bg-gray-100">◀</button>
                    <button class="p-1 rounded hover:bg-gray-100">▶</button>
                </div>
            </div>
            {{-- <div class="divide-y"> --}}
            <div class="h-96">
                <div class="divide-y">
                    <!-- Sample row -->
                    <a href="/dashboard-admin/detail-kotak-masuk">
                        <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" />
                                <span class="text-gray-400">☆</span>
                                <span class="font-medium text-gray-800">Search Console</span>
                                <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                    consectetur
                                    adipiscing elit...</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                                <span class="text-sm text-gray-400">Apr, 24</span>
                            </div>
                        </div>
                    </a>
                    <!-- Example 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <!-- Example 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <!-- Example 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <!-- Example 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <!-- Example 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                    <!-- Example 2 -->
                    <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" />
                            <span class="text-gray-400">☆</span>
                            <span class="font-medium text-gray-800">Search Console</span>
                            <span class="text-sm text-gray-500 truncate max-w-xs">Lorem ipsum dolor sit amet,
                                consectetur
                                adipiscing elit...</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Feedback</span>
                            <span class="text-sm text-gray-400">Apr, 24</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}


        </div>
    </div>
</div>
@endsection
