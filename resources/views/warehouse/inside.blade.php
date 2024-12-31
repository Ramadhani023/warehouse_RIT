<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .border-under {
            display: inline-block;
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <nav class="bg-Mid-blue fixed w-full z-50 " style="top: 0;">
        <div class=" flex flex-wrap justify-between items-center mx-auto p-4 ">
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
                    <li>
                        <a href="{{ route('warehouse.main') }}"
                            class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4 md:ps-12">WAREHOUSE</a>
                    </li>
                    <li>
                        <a href="../../invoice/invoice"
                            class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4">INVOICE</a>
                    </li>
                    <li>
                        <a href="/profile"
                            class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4">PROFILE</a>
                    </li>
                    <!-- Dropdown Trigger -->
                    <li class="relative group mt-2">
                        <button class=" text-white focus:outline-none block py-2 px-3">
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
                            <input type="text" id="product-name" name="product_name" placeholder="Item Name"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Category -->
                            <select id="product-category" name="product_category"
                                class="mt-1 p-2 border-under w-full text-black" required>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>

                            <!-- Quantity -->
                            <input type="number" id="product-qty" name="product_qty" placeholder="Quantity"
                                max="900000000" class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- Serial -->
                            <input type="text" id="product-serial" name="serial" placeholder="Serial"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <!-- manufaktur -->
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
                            <input type="text" id="manufacturer" name="manufacturer" placeholder="Manufacturer"
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


        <!-- Modal Structure -->
        <section class="wrap-table mt-20 border border-gray-300 shadow-md rounded-lg">
            <h1 class="text-2xl font-bold text-gray-800 mb-2 ml-3 mt-3">{{ $warehouse->warehouse_name }}</h1>
            <div class="overflow-x-auto">
                <form id="searchForm" method="GET" action="{{ route('warehouse.inside', ['id' => $warehouse->id]) }}">
                    <div class="flex items-center mb-2 px-4">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Search products..."
                            class="border border-gray-300 rounded-md px-4 py-2 w-full max-w-xs focus:ring focus:ring-blue-300 focus:outline-none">
                        <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Search
                        </button>
                    </div>
                </form>
        
                <table class="min-w-full border-collapse border border-gray-200">
                    <!-- Table Header -->
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-300 text-gray-700">
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Product Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Category</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Quantity</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Serial</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Manufacturer</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Last Inspection</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-200">Next Inspection</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="bg-white">
                        @foreach ($products as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $product->product_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $product->category->category_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-center border-r border-gray-200">{{ $product->product_qty }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $product->serial }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $product->manufaktur }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $product->last_inspection }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-200">{{ $product->next_inspection }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 flex space-x-2">
                                    <button
                                        class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600 open-edit"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->product_name }}"
                                        data-product-category="{{ $product->category->id }}"
                                        data-product-qty="{{ $product->product_qty }}"
                                        data-product-serial="{{ $product->serial }}"
                                        data-product-manufaktur="{{ $product->manufaktur }}"
                                        data-product-last_inspection="{{ $product->last_inspection }}"
                                        data-product-next_inspection="{{ $product->next_inspection }}">
                                        Edit
                                    </button>
                                    <button
                                        class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600 open-delete"
                                        data-product-id="{{ $product->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        
    </section>


    <script>
        // script navbar

        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.querySelector("[data-collapse-toggle]");
            const menu = document.getElementById("mega-menu-full");

            toggleButton.addEventListener("click", function() {
                menu.classList.toggle("hidden");
            });
        });


        // end script navbar

        // script modal
        document.addEventListener('DOMContentLoaded', () => {
            function hideNavbarOnModalOpen() {
                const menu = document.getElementById("mega-menu-full");
                if (!menu.classList.contains("hidden")) {
                    menu.classList.add("hidden");
                }
            }

            // Modal untuk EDIT ITEM
            const openEdit = document.querySelectorAll('.open-edit');
            const closeEdit = document.getElementById('close-edit');
            const editOverlay = document.getElementById('edit-overlay');

            // Modal untuk DELETE ITEM
            const openDelete = document.querySelectorAll('.open-delete');
            const closeDelete = document.getElementById('close-delete');
            const deleteOverlay = document.getElementById('delete-overlay');

            // Modal untuk DELETE WAREHOUSE
            const openDeleteWh = document.getElementById('open-deletewh');
            const closeDeleteWh = document.getElementById('close-deletewh');
            const deleteWhOverlay = document.getElementById('deletewh-overlay');

            // Modal untuk EDIT WAREHOUSE
            const openEditWh = document.getElementById('open-editwh');
            const closeEditWh = document.getElementById('close-editwh');
            const editWhOverlay = document.getElementById('editwh-overlay');

            // Modal untuk ADD ITEM
            const openAdd = document.getElementById('open-add');
            const closeAdd = document.getElementById('close-add');
            const addOverlay = document.getElementById('add-overlay');

            // Modal untuk ADD CATEGORY
            const openAddc = document.getElementById('open-addc');
            const closeAddc = document.getElementById('close-addc');
            const addcOverlay = document.getElementById('addc-overlay');

            // Edit Item Modal
            openEdit.forEach(button => {
                button.addEventListener('click', () => {
                    const productId = button.dataset.productId;
                    const productName = button.dataset.productName;
                    const productCategory = button.dataset.productCategory;
                    const productQty = button.dataset.productQty;
                    const productSerial = button.dataset.productSerial || ''; // Add serial data
                    const productManufaktur = button.dataset.productManufaktur ||
                        ''; // Add manufacturer data
                    const last_Inspection = button.getAttribute('data-product-last_inspection');
                    const next_Inspection = button.getAttribute('data-product-next_inspection');

                    // Set the values for the form fields
                    document.getElementById('product-id').value = productId;
                    document.getElementById('product-name').value = productName;
                    document.getElementById('product-category').value = productCategory;
                    document.getElementById('product-qty').value = productQty;
                    document.getElementById('product-serial').value = productSerial; // Set serial
                    document.getElementById('product-manufaktur').value = productManufaktur; // Set manufacturer
                    document.getElementById('last_inspection').value = last_Inspection; // Corrected
                    document.getElementById('next_inspection').value = next_Inspection; // Corrected

                    // Set the action URL dynamically
                    document.getElementById('edit-product-form').action =
                        `/warehouse/product/edit/${productId}`;

                    // Show the modal
                    editOverlay.classList.remove('hidden');
                });
            });

            closeEdit.addEventListener('click', () => {
                editOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === editOverlay) {
                    editOverlay.classList.add('hidden');
                }
            });

            // Delete Item Modal
            openDelete.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.closest('button').dataset
                        .productId; // Get product ID from table row

                    // Set the action URL dynamically for the form inside the delete modal
                    const deleteForm = document.querySelector(
                        '#delete-form'); // Make sure your delete form has this ID
                    deleteForm.action =
                        `/warehouse/product/delete/${productId}`; // Update action with product ID


                    deleteOverlay.classList.remove('hidden'); // Show delete modal
                });
            });

            closeDelete.addEventListener('click', () => {
                deleteOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === deleteOverlay) {
                    deleteOverlay.classList.add('hidden');
                }
            });


            // Delete Warehouse Modal
            openDeleteWh.addEventListener('click', () => {
                deleteWhOverlay.classList.remove('hidden');
                hideNavbarOnModalOpen();
            });

            closeDeleteWh.addEventListener('click', () => {
                deleteWhOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === deleteWhOverlay) {
                    deleteWhOverlay.classList.add('hidden');
                }
            });

            // Edit Warehouse Modal
            openEditWh.addEventListener('click', () => {
                editWhOverlay.classList.remove('hidden');
                hideNavbarOnModalOpen();
            });

            closeEditWh.addEventListener('click', () => {
                editWhOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === editWhOverlay) {
                    editWhOverlay.classList.add('hidden');
                }
            });

            // Add Item Modal
            openAdd.addEventListener('click', () => {
                addOverlay.classList.remove('hidden');
                hideNavbarOnModalOpen();
            });

            closeAdd.addEventListener('click', () => {
                addOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === addOverlay) {
                    addOverlay.classList.add('hidden');
                }
            });

            // Add Category Modal
            openAddc.addEventListener('click', () => {
                addcOverlay.classList.remove('hidden');
                hideNavbarOnModalOpen();
            });

            closeAddc.addEventListener('click', () => {
                addcOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === addcOverlay) {
                    addcOverlay.classList.add('hidden');
                }
            });
        });
        // end script 
    </script>

</body>

</html>