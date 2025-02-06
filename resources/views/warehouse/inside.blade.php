<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse | Inside</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .border-under {
            display: inline-block;
            border-bottom: 1px solid black;
        }

        .bg-Mid-blue-light {
            background-color: #265665;
        }
    </style>
</head>

<body>
    <nav class="bg-Mid-blue fixed w-full z-50" style="top: 0;">
        <div class="flex flex-wrap justify-between items-center mx-auto p-4">
            <h1 class="lg:text-4xl md:text-2xl sm:text-xl text-white">Warehouse</h1>

            <button data-collapse-toggle="mega-menu-full" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg hover:bg-transparent focus:outline-none focus:ring-2 focus:ring-gray-200 lg:hidden"
                aria-controls="mega-menu-full" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            {{-- Navbar menu --}}
            <div id="mega-menu-full" class="hidden w-full md:hidden lg:block lg:w-auto sm:text-xs md:text-lg">
                <ul class="lg:flex lg:flex-row md:p-0 rounded-lg bg-transparent md:space-x-8 md:grid  md:border-0">
                    @if (Auth::user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="block py-2 px-4 text-white rounded hover:text-slate-300 bg-Mid-blue-light md:p-4">USERS</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.borrow.index') }}"
                                class="block py-2 px-4 text-white rounded hover:text-slate-300 bg-Mid-blue-light md:p-4">BOINDEX</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('warehouse.main') }}"
                            class="block py-2 px-4 text-white rounded hover:text-slate-300 bg-Mid-blue-light md:p-4">WAREHOUSE</a>
                    </li>
                    <li>
                        <a href="../../invoice/invoice"
                            class="block py-2 px-4 text-white rounded hover:text-slate-300 bg-Mid-blue-light md:p-4">INVOICE</a>
                    </li>
                    <li>
                        <a href="/profile"
                            class="block py-2 px-4 text-white rounded hover:text-slate-300 bg-Mid-blue-light md:p-4">PROFILE</a>
                    </li>
                    <!-- Dropdown Trigger -->
                    <li class="relative group mt-2">
                        <button class="text-white focus:outline-none block py-2 px-4 bg-Mid-blue-light rounded">
                            OPERATIONS
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <ul
                            class="absolute left-0 mt-2 w-48 bg-Mid-blue text-white rounded-lg shadow-lg hidden group-hover:block z-50 sm:w-full">
                            <li><button id="open-editwh" class="block px-4 py-2 hover:text-slate-300 "><i
                                        class="fa-solid fa-pen me-2"></i> EDIT</button></li>
                            <li><button id="open-deletewh" class="block px-4 py-2 hover:text-slate-300 "><i
                                        class="fa-solid fa-trash me-2"></i> DELETE</button></li>
                            <li><button id="open-add" class="block px-4 py-2 hover:text-slate-300 "><i
                                        class="fa-solid fa-plus me-2"></i> ADD ITEM</button></li>
                            <li><button id="open-addc" class="block px-4 py-2 hover:text-slate-300 "><i
                                        class="fa-solid fa-plus me-2"></i> ADD CATEGORY</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
            {{-- end navbar menu --}}
        </div>
    </nav>

    <section class="py-8 lg:px-16 md:px-12 px-2 relative">

        <!-- Modal Structure -->
        <div id="edit-overlay"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden sm:text-xs md:text-xl overflow-y-auto">
            {{-- Edit itm overlay --}}
            <div id="modal-edit"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="md:text-2xl sm:text-xl mb-4 text-black font-semibold">EDIT ITEM</h2>
                    <form id="edit-product-form" action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="my-8">
                            <input type="hidden" id="product-id" name="product_id">

                            <!-- Item Name -->
                            <label for="last inspection" class="block text-sm font-medium text-gray-700 mt-4">Item
                                Name</label>
                            <input type="text" id="product-name" name="product_name" placeholder="Item Name"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Category -->
                            <label for="last inspection"
                                class="block text-sm font-medium text-gray-700 mt-4">Category</label>
                            <select id="product-category" name="product_category"
                                class="mt-1 p-2 border-under w-full text-black" required>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>

                            <!-- Quantity -->
                            <label for="last inspection"
                                class="block text-sm font-medium text-gray-700 mt-4">Quantity</label>
                            <input type="number" id="product-qty" name="product_qty" placeholder="Quantity"
                                max="900000000" class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Serial -->
                            <label for="last inspection"
                                class="block text-sm font-medium text-gray-700 mt-4">Serial</label>
                            <input type="text" id="product-serial" name="serial" placeholder="Serial"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- manufaktur -->
                            <label for="last inspection"
                                class="block text-sm font-medium text-gray-700 mt-4">Manufacture</label>
                            <input type="text" id="product-manufaktur" name="manufaktur" placeholder="manufaktur"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Last_Inspection -->
                            <label for="last inspection" class="block text-sm font-medium text-gray-700 mt-4">Last
                                Inspection</label>
                            <input type="date" id="last_inspection" name="last_inspection"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Next_Inspection -->
                            <label for="next_inspection" class="block text-sm font-medium text-gray-700 mt-4">Next
                                Inspection</label>
                            <input type="date" id="next_inspection" name="next_inspection"
                                class="mt-1 p-2 border-under w-full text-black" required>
                        </div>
                        <div class="flex justify-between">
                            <button id="close-edit" type="button"
                                class=" px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold ">CANCEL</button>
                            <button type="submit"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">EDIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>{{-- End Edit itm overlay --}}

        <div id="delete-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden"> {{-- Hapus itm overlay --}}
            <div id="modal-delete-item"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="text-xl lg:mb-20 mb-8 mt-4 text-black font-semibold text-center ">DELETE ITEM?</h2>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="warehouse_id" value="{{ $warehouse->id }}">
                        <div class="flex gap-2 justify-between">
                            <button id="close-delete" type="button"
                                class=" px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold">CANCEL</button>
                            <button type="delete"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">DELETE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>{{-- End Hapus itm overlay --}}

        <div id="deletewh-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden"> {{-- Hapus itm overlay --}}
            <div id="modal-edit"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="text-xl lg:mb-20 mb-8 mt-4 text-black font-semibold text-center ">DELETE WAREHOUSE?
                    </h2>
                    <form action="{{ route('warehouse.delete', $warehouse->id) }}" method="post">
                        @csrf
                        <div class="flex justify-between">
                            <button id="close-deletewh" type="button"
                                class=" px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold">CANCEL</button>
                            <button type="delete"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">DELETE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>{{-- End Hapus itm overlay --}}

        <div id="editwh-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden"> {{-- Edit Warehouse overlay --}}
            <div id="modal-edit-wh"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="text-xl mb-4 text-black font-semibold">EDIT WAREHOUSE</h2>
                    <form action="{{ route('warehouse.update', $warehouse->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="my-8">
                            <input type="text" id="wh-name" name="warehouse_name" placeholder="Warehouse Name"
                                value="{{ $warehouse->warehouse_name }}"
                                class="mt-1 p-2 border-under w-full text-black" required>
                        </div>
                        <div class="flex justify-between">
                            <button id="close-editwh" type="button"
                                class=" px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold">CANCEL</button>
                            <button type="editwh"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">EDIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="add-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden overflow-y-auto">
            {{-- Add Item overlay --}}
            <div id="modal-add"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div
                    class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3 max-h-screen overflow-y-auto">
                    <h2 class="text-xl mb-4 text-black font-semibold">ADD ITEM</h2>
                    <form action="{{ route('warehouse.addi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="warehouse_id" value="{{ $warehouse->id }}">

                        <div class="my-8">
                            <!-- Item Name -->
                            <input type="text" id="item-name" name="product_name" placeholder="Item Name"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Category -->
                            <select id="category" name="product_category"
                                class="mt-1 p-2 border-under w-full text-black" required>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>

                            <!-- Quantity -->
                            <input type="number" id="quantity" name="product_qty" placeholder="Quantity"
                                max="900000000" class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Serial -->
                            <input type="text" id="serial" name="serial" placeholder="Serial"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Manufacturer -->
                            <input type="text" id="manufaktur" name="manufaktur" placeholder="Manufacturer"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Last_Inspection -->
                            <label for="last_inspection" class="block text-sm font-medium text-gray-700 mt-4">Last
                                _Inspection</label>
                            <input type="date" id="last_inspection" name="last_inspection"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Next_Inspection -->
                            <label for="next_inspection" class="block text-sm font-medium text-gray-700 mt-4">Next
                                _Inspection</label>
                            <input type="date" id="next_inspection" name="next_inspection"
                                class="mt-1 p-2 border-under w-full text-black" required>
                        </div>

                        <div class="flex justify-between">
                            <button id="close-add" type="button"
                                class="px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold">CANCEL</button>
                            <button type="submit"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- add category --}}
        <div id="addc-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden"> {{-- Add Category overlay --}}
            <div id="modal-addc"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="text-xl mb-4 text-black font-semibold">ADD CATEGORY</h2>
                    <form action="{{ route('warehouse.addc') }}" method="POST">
                        @csrf
                        {{-- Hidden field to include the warehouse ID --}}
                        <input type="hidden" name="warehouse_id" value="{{ $warehouse->id }}">

                        <div class="my-8">
                            <input type="text" id="category-name" name="category_name"
                                placeholder="Category Name" class="mt-1 p-2 border-under w-full text-black" required>
                        </div>
                        <div class="flex justify-between">
                            <button id="close-addc" type="button"
                                class="px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold">CANCEL</button>
                            <button type="submit"
                                class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="borrow-overlay"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden sm:text-xs md:text-xl overflow-y-auto">
            {{-- Borrow item overlay --}}
            <div id="modal-borrow"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-lg shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="md:text-2xl sm:text-xl mb-4 text-black font-semibold">BORROW ITEM</h2>
                    <form id="borrow-product-form" action="{{ route('warehouse.borrow') }}" method="POST">
                        @csrf
                        <input type="hidden" id="product-id2" name="product_id">
                        <div class="my-8">
                            <!-- Borrower Name -->
                            <label for="last inspection"
                                class="block text-sm font-medium text-gray-700 mt-4">Name</label>
                            <input type="text" id="borrower-name" name="borrower_name" placeholder="Your Name"
                                value="{{ Auth::user()->name }}" class="mt-1 p-2 border-under w-full text-black"
                                readonly required>

                            <!-- Item Name -->
                            <label for="last inspection" class="block text-sm font-medium text-gray-700 mt-4">Item
                                Name</label>
                            <input type="text" id="borrow-item-name" name="borrow_item_name"
                                class="mt-1 p-2 border-under w-full text-black" readonly required>

                            <!-- Quantity -->
                            <label for="last inspection"
                                class="block text-sm font-medium text-gray-700 mt-4">QTY</label>
                            <input type="number" id="borrow-qty" name="borrow_qty" placeholder="Quantity"
                                max="900000000" class="mt-1 p-2 border-under w-full text-black" required>

                        </div>
                        <div class="flex justify-between mt-6">
                            <button id="close-borrow" type="button"
                                class="px-6 py-3 bg-gray-300 text-black rounded-lg font-semibold hover:bg-gray-400 transition">CANCEL</button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition">BORROW</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> {{-- End Borrow item overlay --}}

        <!-- Modal Structure -->
        <section class="wrap-table mt-20 border border-gray-300 shadow-md rounded-lg">
            <h1 class="text-2xl font-bold text-gray-800 ml-3 mt-3">{{ $warehouse->warehouse_name }}</h1>
            <div class="overflow-x-auto">
                <div class="my-3 mx-3">
                    <input type="text" id="search-bar" placeholder="Search..."
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <table class="min-w-full border-collapse border border-gray-200" id="product-table">
                    <!-- Table Header -->
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-300 text-gray-700">
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200 cursor-context-menu hover:bg-gray-200"
                                onclick="sortTable('number')">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Product Name
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Category
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200 cursor-context-menu hover:bg-gray-200"
                                onclick="sortTable('quantity')">Quantity</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Serial</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Manufacturer
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Last
                                Inspection</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Next
                                Inspection</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="bg-white">
                        @foreach ($products as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">
                                    {{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">
                                    {{ $product->product_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">
                                    {{ $product->category->category_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-center border-r border-gray-200">
                                    {{ $product->product_qty }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">
                                    {{ $product->serial }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">
                                    {{ $product->manufaktur }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">
                                    {{ $product->last_inspection }}</td>
                                <td
                                    class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200 
                                    @if (now()->diffInDays($product->next_inspection) <= 7) bg-yellow-300 @endif">
                                    {{ $product->next_inspection }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 flex space-x-2">
                                    <button
                                        class="open-edit bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->product_name }}"
                                        data-product-category="{{ $product->category->id }}"
                                        data-product-qty="{{ $product->product_qty }}"
                                        data-product-serial="{{ $product->serial }}"
                                        data-product-manufaktur="{{ $product->manufaktur }}"
                                        data-product-last-inspection="{{ $product->last_inspection }}"
                                        data-product-next-inspection="{{ $product->next_inspection }}">
                                        Edit
                                    </button>
                                    <button
                                        class="open-delete bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600"
                                        data-product-id="{{ $product->id }}">
                                        Delete
                                    </button>
                                    <button
                                        class="open-borrow bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->product_name }}">
                                        Borrow
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="no-items-message" class="hidden text-center text-gray-600 mt-4 mb-4">No products/items match
                    your search.</div>
            </div>
        </section>

    </section>


    <script>
    function sortTable(column) {
        const table = document.getElementById("product-table");
        const rows = Array.from(table.rows).slice(1); // Exclude header row
        const isAscending = table.dataset.sortOrder === "asc";

        rows.sort((a, b) => {
            let valueA, valueB;
            if (column === 'quantity') {
                valueA = parseInt(a.cells[3].innerText); // Quantity column index
                valueB = parseInt(b.cells[3].innerText);
            } else if (column === 'number') {
                valueA = parseInt(a.cells[0].innerText); // Number column index
                valueB = parseInt(b.cells[0].innerText);
            }
            return isAscending ? valueA - valueB : valueB - valueA;
        });

        // Toggle sort order
        table.dataset.sortOrder = isAscending ? "desc" : "asc";

        // Append sorted rows to the table body
        const tbody = table.tBodies[0];
        tbody.innerHTML = "";
        rows.forEach(row => tbody.appendChild(row));
    }

        // Script: Navbar
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.querySelector("[data-collapse-toggle]");
            const menu = document.getElementById("mega-menu-full");

            toggleButton.addEventListener("click", function() {
                menu.classList.toggle("hidden");
            });
        });
        // End Navbar Script

        // Script: Modal
        document.addEventListener("DOMContentLoaded", () => {
            function hideNavbarOnModalOpen() {
                const menu = document.getElementById("mega-menu-full");
                if (!menu.classList.contains("hidden")) {
                    menu.classList.add("hidden");
                }
            }

            // Generic modal functions
            function setupModal(openButtons, closeButton, overlay) {
                if (openButtons) {
                    openButtons.forEach(button => {
                        button.addEventListener("click", () => overlay.classList.remove("hidden"));
                    });
                }

                if (closeButton) {
                    closeButton.addEventListener("click", () => overlay.classList.add("hidden"));
                }

                window.addEventListener("click", (e) => {
                    if (e.target === overlay) overlay.classList.add("hidden");
                });
            }

            // Edit Item Modal
            const editOverlay = document.getElementById("edit-overlay");
            const openEdit = document.querySelectorAll(".open-edit");
            const closeEdit = document.getElementById("close-edit");

            openEdit.forEach(button => {
                button.addEventListener("click", () => {
                    const productId = button.dataset.productId;
                    const productName = button.dataset.productName;
                    const productCategory = button.dataset.productCategory;
                    const productQty = button.dataset.productQty;
                    const productSerial = button.dataset.productSerial || "";
                    const productManufaktur = button.dataset.productManufaktur || "";
                    const lastInspection = button.dataset.productLastInspection;
                    const nextInspection = button.dataset.productNextInspection;

                    document.getElementById("product-id").value = productId;
                    document.getElementById("product-name").value = productName;
                    document.getElementById("product-category").value = productCategory;
                    document.getElementById("product-qty").value = productQty;
                    document.getElementById("product-serial").value = productSerial;
                    document.getElementById("product-manufaktur").value = productManufaktur;
                    document.getElementById("last_inspection").value = lastInspection;
                    document.getElementById("next_inspection").value = nextInspection;

                    document.getElementById("edit-product-form").action =
                        `/warehouse/product/edit/${productId}`;
                    editOverlay.classList.remove("hidden");
                });
            });
            setupModal(null, closeEdit, editOverlay);

            // Delete Item Modal
            const deleteOverlay = document.getElementById("delete-overlay");
            const openDelete = document.querySelectorAll(".open-delete");
            const closeDelete = document.getElementById("close-delete");

            openDelete.forEach(button => {
                button.addEventListener("click", () => {
                    const productId = button.dataset.productId;
                    const deleteForm = document.querySelector("#delete-form");
                    deleteForm.action = `/warehouse/product/delete/${productId}`;
                    deleteOverlay.classList.remove("hidden");
                });
            });
            setupModal(null, closeDelete, deleteOverlay);

            // Borrow Item Modal
            const borrowOverlay = document.getElementById("borrow-overlay");
            const openBorrowButtons = document.querySelectorAll(".open-borrow");
            const closeBorrowButton = document.getElementById("close-borrow");

            openBorrowButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const productId = button.dataset.productId;
                    const productName = button.dataset.productName;

                    console.log("Product ID:", productId); // Log the product ID
                    console.log("Product Name:", productName); // Log the product ID

                    document.getElementById("borrow-item-name").value = productName;
                    document.getElementById("product-id2").value =
                        productId; // Set the product_id field
                    borrowOverlay.classList.remove("hidden");
                });
            });
            closeBorrowButton.addEventListener("click", () => {
                borrowOverlay.classList.add("hidden");
            });

            // Additional modals (Add, Edit, Borrow, Category, Warehouse)
            const modalConfigs = [{
                    open: "#open-add",
                    close: "#close-add",
                    overlay: "#add-overlay"
                },
                {
                    open: "#open-addc",
                    close: "#close-addc",
                    overlay: "#addc-overlay"
                },
                {
                    open: "#open-borrow",
                    close: "#close-borrow",
                    overlay: "#borrow-overlay"
                },
                {
                    open: "#open-deletewh",
                    close: "#close-deletewh",
                    overlay: "#deletewh-overlay"
                },
                {
                    open: "#open-editwh",
                    close: "#close-editwh",
                    overlay: "#editwh-overlay"
                }
            ];

            modalConfigs.forEach(({
                open,
                close,
                overlay
            }) => {
                const openButton = document.querySelector(open);
                const closeButton = document.querySelector(close);
                const modalOverlay = document.querySelector(overlay);

                setupModal(openButton ? [openButton] : null, closeButton, modalOverlay);
            });
        });


        // Script: Search Bar Filtering
        document.getElementById("search-bar").addEventListener("input", function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll("#product-table tbody tr");
            let visibleRows = 0;

            rows.forEach(row => {
                const rowText = row.innerText.toLowerCase();
                if (rowText.includes(query)) {
                    row.style.display = "";
                    visibleRows++;
                } else {
                    row.style.display = "none";
                }
            });

            const noItemsMessage = document.getElementById("no-items-message");
            noItemsMessage.classList.toggle("hidden", visibleRows !== 0);
        });
    </script>



</body>

</html>
