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
        <div id="edit-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden sm:text-xs md:text-xl">
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

                            <input type="text" id="product-name" name="product_name" placeholder="Item Name"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <select type="text" id="product-category" name="product_category" placeholder="Category"
                                class="mt-1 p-2 border-under w-full text-black" required>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>

                            <input type="number" id="product-qty" name="product_qty" placeholder="Quantity"
                               max="900000000" class="mt-1 p-2 border-under w-full text-black" required>
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

        <div id="add-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden"> {{-- Add Item overlay --}}
            <div id="modal-add"
                class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16">
                <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                    <h2 class="text-xl mb-4 text-black font-semibold">ADD ITEM</h2>
                    <form action="{{ route('warehouse.addi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="warehouse_id" value="{{ $warehouse->id }}">
                        <div class="my-8">
                            <input type="text" id="item-name" name="product_name" placeholder="Item Name"
                                class="mt-1 p-2 border-under w-full text-black" required>

                            <select type="text" id="category" name="product_category" placeholder="Category"
                                class="mt-1 p-2 border-under w-full text-black" required>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>

                            <input type="number" id="quantity" name="product_qty" placeholder="Quantity"
                                max="900000000" class="mt-1 p-2 border-under w-full text-black" required>
                        </div>
                        <div class="flex justify-between">
                            <button id="close-add" type="button"
                                class=" px-4 py-2 bg-gray-300 text-black h-auto rounded-lg font-bold">CANCEL</button>
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
        <section class="wrap-table mt-20 border border-gray-300 sm:p-4 p-2 shadow-lg shadow-slate-400 rounded-xl">
            <h1 class="lg:text-3xl md:text-2xl text-xl font-bold my-4">{{ $warehouse->warehouse_name }}</h1>
            <table class="table w-full rounded-md overflow-hidden ">
                <thead>
                    <tr class="border border-gray-300 text-gray-600 bg-gray-200">
                        <th class="lg:text-lg md:text-md text-xs">#</th>
                        <th class="lg:px-4 md:px-2 sm:px-1 py-4 flex-wrap lg:text-lg md:text-md text-xs">PRODUCT
                            NAME</th>
                        <th class="lg:text-lg md:text-md text-xs">PRODUCT CATEGORY</th>
                        <th class="lg:text-lg md:text-md text-xs">QTY</th>
                        <th class="lg:text-lg md:text-md text-xs">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border border-gray-300">
                            <!-- Numbering -->
                            <td class="lg:p-4 md:p-2 p-1 py-6 lg:text-xl md:text-lg sm:text-sm text-center">
                                {{ $loop->iteration }}
                            </td>
                            <!-- Product Name with Textarea -->
                            <td class="lg:p-4 md:p-2 p-1 py-6 lg:text-xl md:text-lg sm:text-sm whitespace-nowrap max-w-[150px]">
                                <div class="border-2 border-slate-400 rounded-lg p-1 w-full shadow-xl">
                                    <p class="h-16 overflow-y-scroll p-3">
                                        {{$product->product_name}}
                                    </p>
                                </div>
                            </td>
                            
                            <!-- Category Name -->
                            <td class="text-center lg:text-xl md:text-lg sm:text-sm overflow-auto whitespace-nowrap max-w-[150px]">
                                {{ $product->category->category_name }}
                            </td>
                            <!-- Quantity -->
                            <td class="text-center lg:text-xl md:text-lg sm:text-sm">
                                {{ $product->product_qty }}
                            </td>
                            <!-- Action Buttons -->
                            <td class="text-center justify-center gap-2 place-items-center flex py-6 p-1">
                                <button
                                    class="open-edit bg-green-600 p-1 lg:rounded md:rounded sm:rounded rounded-full inline-flex items-center justify-center w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->product_name }}"
                                    data-product-category="{{ $product->product_category }}"
                                    data-product-qty="{{ $product->product_qty }}">
                                    <i class="fa-solid fa-pencil lg:text-xl md:text-lg sm:text-sm text-xs"></i>
                                </button>
                                <button data-product-id="{{ $product->id }}"
                                        class="open-delete bg-red-600 p-1 lg:rounded md:rounded sm:rounded rounded-full inline-flex items-center justify-center w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10">
                                    <i class="fa-solid fa-trash lg:text-xl md:text-lg sm:text-sm text-xs"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
                
            </table>

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

                    // Set the values for the form fields
                    document.getElementById('product-id').value = productId;
                    document.getElementById('product-name').value = productName;
                    document.getElementById('product-category').value = productCategory;
                    document.getElementById('product-qty').value = productQty;

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
