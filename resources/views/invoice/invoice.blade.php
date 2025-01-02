<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>
    @vite('resources/css/app.css')
    <style>
        .shadow-active {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    @include('navbar')
    <section id="sortir" class="md:p-24 sm:p-12 p-6">
        <h1 class="font-bold text-2xl md:mt-10 mt-16 mb-4">PRODUCTS FROM ALL WAREHOUSE(S)</h1>
        <div class="justify-between sm:flex md:gap-6 sm:gap-1">

            <!-- Available Stock Button -->
            <div class="sortir border-2 border-gray-300 rounded-lg lg:py-6 lg:px-10 md:py-4 md:px-8 sm:py-2 sm:px-4 py-1 px-2 my-2 flex sm:w-1/3 hover:shadow-lg"
                data-category="available">
                <img src="{{ asset('img/box.png') }}" alt="box" class="lg:w-14 lg:h-14 w-15 h-16 mx-3">
                <div class="sm:grid flex flex-row-reverse items-center justify-between w-full text-center">
                    <h1 class="font-bold lg:text-3xl sm:text-2xl">{{ $availableStockCount }} ITEM</h1>
                    <p class="lg:text-sm md:text-center">Available Stock</p>
                </div>
            </div>

            <!-- Low Stock Button -->
            <div class="sortir border-2 border-gray-300 rounded-lg lg:py-6 lg:px-10 md:py-4 md:px-8 sm:py-2 sm:px-4 py-1 px-2 my-2 flex sm:w-1/3 hover:shadow-lg"
                data-category="low">
                <img src="{{ asset('img/boxAdd.png') }}" alt="box" class="lg:w-15 lg:h-14 w-17 h-16 mr-3">
                <div class="sm:grid flex flex-row-reverse items-center justify-between w-full text-center">
                    <h1 class="font-bold lg:text-3xl sm:text-2xl">{{ $lowStockCount }} ITEM</h1>
                    <p class="lg:text-sm">Low Stock</p>
                </div>
            </div>

            <!-- Out of Stock Button -->
            <div class="sortir border-2 border-gray-300 rounded-lg lg:py-6 lg:px-10 md:py-4 md:px-8 sm:py-2 sm:px-4 py-1 px-2 my-2 flex sm:w-1/3 hover:shadow-lg"
                data-category="out-of-stock">
                <img src="{{ asset('img/boxFor.png') }}" alt="box" class="lg:w-15 lg:h-14 w-17 h-16 mr-3">
                <div class="sm:grid flex flex-row-reverse items-center justify-between w-full text-center">
                    <h1 class="font-bold lg:text-3xl sm:text-2xl">{{ $outOfStockCount }} ITEM</h1>
                    <p class="lg:text-sm">Out Of Stock</p>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <section class="wrap-table mt-10 border border-gray-300 p-4 shadow-lg shadow-slate-400 rounded-xl">
            <h1 class="md:text-3xl sm:text-2xl text-xl font-bold my-4">Product List</h1>

            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="search-bar" placeholder="Search..."
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200 rounded-md overflow-hidden">
                    <thead>
                        <tr class="bg-Mid-blue text-gray-200 border-b border-gray-300">
                            <th class="px-4 py-3 text-center text-sm font-semibold border-r border-gray-300">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-300">Warehouse
                                Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-r border-gray-300">Product Name
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold border-r border-gray-300">Quantity
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold border-r border-gray-300">Category
                            </th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Serial</th>
                        </tr>
                    </thead>
                    <tbody id="product-table" class="bg-white">
                        @if ($products->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500 font-bold">
                                    No Products / Items
                                </td>
                            </tr>
                        @else
                            @foreach ($products as $product)
                                <tr class=" border-b border-gray-300"
                                    data-stock="{{ $product->product_qty > 5 ? 'available' : ($product->product_qty > 0 ? 'low' : 'out-of-stock') }}">
                                    <td class="px-4 py-3 text-center text-sm text-gray-700 border-r border-gray-300">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-sm text-gray-700 border-r border-gray-300 {{ $product->warehouse ? '' : 'bg-red-300 ' }}">
                                        {{ $product->warehouse ? $product->warehouse->warehouse_name : 'No Warehouse' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700 border-r border-gray-300">
                                        {{ $product->product_name }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center text-sm text-gray-700 border-r border-gray-300 {{ $product->product_qty == 0 ? 'bg-red-300' : ($product->product_qty <= 5 ? 'bg-yellow-300' : ($product->product_qty > 5 ? 'bg-green-300' : '')) }}">
                                        {{ $product->product_qty }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-700">
                                        {{ $product->category ? $product->category->category_name : 'No Category' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-700">
                                        {{ $product->category ? $product->serial : 'No Category' }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>


    </section>

    <script>
        // Search bar functionality
        document.getElementById('search-bar').addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#product-table tr');

                    if (query === "") {
                        // If search bar is empty, show all rows and remove the "No Products / Items" message
                        rows.forEach(row => {
                            row.style.display = ""; // Show all rows
                        });
                        removeNoItemsMessage();
                        return;
                    }

                    // Filter rows based on the search query
                    let visibleRows = 0;
                    rows.forEach(row => {
                        const rowText = row.innerText.toLowerCase();
                        if (rowText.includes(query)) {
                            row.style.display = ""; // Show matching rows
                            visibleRows++;
                        } else {
                            row.style.display = "none"; // Hide non-matching rows
                        }
                    });

                    // Show "No Products / Items" message if no rows match
                    if (visibleRows === 0) {
                        showNoItemsMessage();
                    } else {
                        removeNoItemsMessage();
                    }
                });

                // Sorting functionality
                document.querySelectorAll(".sortir").forEach(button => {
                    button.addEventListener("click", function() {
                        const category = this.getAttribute("data-category");
                        const isActive = this.classList.contains("active");

                        // Remove 'active' class from all buttons
                        document.querySelectorAll(".sortir").forEach(btn => btn.classList.remove("active"));

                        if (isActive) {
                            // If already active, show all items and deactivate filter
                            document.querySelectorAll("#product-table tr").forEach(row => {
                                row.style.display = ""; // Show all rows
                            });
                            removeNoItemsMessage(); // Remove "No Products / Items" message
                        } else {
                            // Activate current button and filter rows
                            this.classList.add("active");
                            let visibleRows = 0;

                            document.querySelectorAll("#product-table tr").forEach(row => {
                                if (row.getAttribute("data-stock") === category) {
                                    row.style.display = ""; // Show matching rows
                                    visibleRows++;
                                } else {
                                    row.style.display = "none"; // Hide non-matching rows
                                }
                            });

                            // If no rows are visible, show "No Products / Items" message
                            if (visibleRows === 0) {
                                showNoItemsMessage();
                            } else {
                                removeNoItemsMessage();
                            }
                        }
                    });
                });

                // Show "No Products / Items" message
                function showNoItemsMessage() {
                    const tableBody = document.getElementById("product-table");
                    let noItemsMessage = document.getElementById("no-items-message");

                    if (!noItemsMessage) {
                        const noItemsRow = document.createElement("tr");
                        noItemsRow.id = "no-items-message";
                        noItemsRow.innerHTML = `
                    <td colspan="6" class="text-center py-4 text-gray-500 font-bold">
                        No Products / Items
                    </td>
                `;
                        tableBody.appendChild(noItemsRow);
                    }
                }

                // Remove "No Products / Items" message
                function removeNoItemsMessage() {
                    const noItemsMessage = document.getElementById("no-items-message");
                    if (noItemsMessage) {
                        noItemsMessage.remove();
                    }
                }
    </script>


</body>

</html>
