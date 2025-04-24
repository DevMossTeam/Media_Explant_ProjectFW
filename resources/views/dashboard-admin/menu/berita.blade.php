@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    <div class="flex items-center justify-between my-5">
        <h1 class="font-bold text-2xl">Daftar Berita Kampus</h1>
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-reset flex">
                <li><a href="#" class="">Home</a></li>
                <li><span class="mx-2">></span></li>
                <li class="text-gray-700">Kampus</li>
            </ol>
        </nav>
    </div>

    <div class="p-6 bg-white shadow rounded-lg">
        {{-- <h2 class="text-lg font-semibold mb-4">Daftar Kampus</h2> --}}

        <div class="flex items-center justify-between mb-4">
            <!-- Left: Dropdown for entries -->
            <div class="relative flex items-center mr-4">
                <div class="mr-2">Show</div>
                <select class="py-1 px-2 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                <div class="ml-2">entries</div>
            </div>
        
            <!-- Right: Search input with max-width and settings button -->
            <div class="flex items-center ml-auto">
                <!-- Search input -->
                <div class="relative max-w-lg mr-4">
                    <input type="text" placeholder="Search..."
                        class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 w-full">
                    <i class="fa fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                </div>
        
                <!-- Settings button -->
                <div class="relative">
                    <button class="p-2 bg-white border rounded-full hover:bg-gray-100">
                        <i class="fa fa-cog text-gray-600"></i>
                    </button>
                </div>
            </div>
        </div>
        
        
        

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-600">
                    <tr>
                        <th class="p-3 w-20">Cover</th>
                        <th class="p-3">Judul</th>
                        <th class="p-3">Penulis</th>
                        <th class="p-3">Visibilitas</th>
                        <th class="p-3">Tgl Diterbitkan</th>
                        <th class="p-3 text-center w-32">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">Judul Artikel Keren</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">
                            <span
                                class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Public</span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">2025-04-24</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <!-- View Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition">
                                <i class="fa fa-eye"></i>
                            </button>
                            <!-- Delete Button -->
                            <button
                                class="w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Tambah baris sesuai kebutuhan -->
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between mt-4 text-sm text-gray-600">
            <div>Showing 1 to 10 of 50 entries</div>
            <div class="flex space-x-1">
                <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-100">Previous</button>
                <button class="px-3 py-1 border rounded bg-blue-500 text-white">1</button>
                <button class="px-3 py-1 border rounded">2</button>
                <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-100">Next</button>
            </div>
        </div>
    </div>



</div>
@endsection
