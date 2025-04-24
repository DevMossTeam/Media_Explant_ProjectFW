@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    <div class="flex items-center justify-between my-5">
        <h1 class="font-bold">Inbox</h1>
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
            <!-- Toolbar actions -->
            <div class="flex items-center gap-2 mb-4 border-b pb-2">
                <button class="p-1 hover:bg-gray-100 rounded">⬅️</button>
                <button class="p-1 hover:bg-gray-100 rounded">🗑</button>
                <button class="p-1 hover:bg-gray-100 rounded">📥</button>
                <button class="p-1 hover:bg-gray-100 rounded">📁</button>
                <button class="p-1 hover:bg-gray-100 rounded">✉️</button>
            </div>

            <!-- Email detail -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/40" alt="avatar" class="w-10 h-10 rounded-full" />
                    <div>
                        <h2 class="font-semibold">Feedback</h2>
                        <p class="text-sm text-gray-500">Codescandy &lt;hello@example.com&gt;</p>
                    </div>
                </div>

                <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                    <p>Hello Dear Alexander,</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ut rutrum mi...</p>
                    <p>Praesent ut rutrum mi. Aenean ac leo non justo suscipit consectetur...</p>
                    <p>Nullam tincidunt sodales diam, quis rhoncus dolor aliquet a...</p>
                    <p>Suspensisse semper vel turpis vitae aliquam. Aenean semper dui...</p>
                </div>

                <!-- Attachments -->
                {{-- <div class="mt-4">
                    <h3 class="font-semibold mb-2">📎 2 Attachments</h3>
                    <div class="flex gap-4">
                        <div class="bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2">
                            <span class="text-red-500">📄</span>
                            <div>
                                <p class="text-sm font-medium">Guidelines.pdf</p>
                                <a href="#" class="text-xs text-blue-500 hover:underline">Download</a>
                            </div>
                        </div>
                        <div class="bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2">
                            <span class="text-yellow-500">🖼️</span>
                            <div>
                                <p class="text-sm font-medium">Branding Assets</p>
                                <a href="#" class="text-xs text-blue-500 hover:underline">Download</a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Action Buttons -->
                {{-- <div class="flex gap-2 mt-6">
                    <button class="bg-gray-100 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">↩️ Reply</button>
                    <button class="bg-gray-100 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">⤴️ Reply All</button>
                    <button class="bg-gray-100 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">➡️ Forward</button>
                </div> --}}
            </div>
        </div>

    </div>
</div>
@endsection

{{-- @section('content')
<div class="h-max-40 overflow-y-scroll border border-gray-300 p-4">
    <!-- Content here will overflow if it's taller than 600px -->
    <p>Lorem ipsum dolor sit amet...</p>
    <!-- Add more content to demonstrate the scroll -->
    <div class="space-y-4">
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <p>Line 1</p>
      <p>Line 2</p>
      <p>Line 3</p>
      <p>Line 4</p>
      <p>Line 5</p>
      <p>Line 6</p>
      <p>Line 7</p>
      <p>Line 8</p>
      <p>Line 9</p>
      <p>Line 10</p>
      <!-- ...and so on -->
    </div>
  </div>
  
@endsection --}}
