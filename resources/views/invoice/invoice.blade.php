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
        <h1 class="font-bold text-2xl md:mt-10 mt-16 mb-4">PRODUCT</h1>
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
            <table class="table w-full rounded-md overflow-hidden">
                <thead>
                    <tr class="border border-gray-300 text-gray-200 bg-Mid-blue">
                        <th class="lg:px-4 md:px-2 sm:px-1 py-4 flex-wrap lg:text-xl md:text-lg sm:text-md text-[10px] text-center">#</th>
                        <th
                            class="lg:px-4 md:px-2 sm:px-1 py-4 flex-wrap lg:text-xl md:text-lg sm:text-md text-[10px] text-start">
                            WAREHOUSE</th>
                        <th class="lg:text-xl md:text-lg sm:text-lg text-[10px]">PRODUCT NAME</th>
                        <th class="lg:text-xl md:text-lg sm:text-lg text-[10px]">QTY</th>
                        <th class="lg:text-xl md:text-lg sm:text-lg text-[10px]">CATEGORY</th>
                    </tr>
                </thead>
                <tbody id="product-table">
                    @if ($products->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 font-bold">
                                No Products / Items
                            </td>
                        </tr>
                    @else
                        @foreach ($products as $product)
                            <tr class="border border-gray-300"
                                data-stock="{{ $product->product_qty > 5 ? 'available' : ($product->product_qty > 0 ? 'low' : 'out-of-stock') }}">
                                <td class="text-center md:text-lg sm:text-lg text-xs">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="lg:p-4 md:p-2 sm:p-1 py-3 md:text-lg sm:text-lg text-xs">
                                    {{ $product->warehouse ? $product->warehouse->warehouse_name : 'No Warehouse' }}
                                </td>
                                <td class="text-center md:text-lg sm:text-lg text-xs">{{ $product->product_name }}</td>
                                <td class="text-center md:text-lg sm:text-lg text-xs">{{ $product->product_qty }}</td>
                                <td class="text-center md:text-lg sm:text-lg text-xs">
                                    {{ $product->category ? $product->category->category_name : 'No Category' }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                
            </table>
        </section>
    </section>

    <script>
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
    
        function showNoItemsMessage() {
            const tableBody = document.getElementById("product-table");
            const noItemsRow = document.createElement("tr");
            noItemsRow.id = "no-items-message";
            noItemsRow.innerHTML = `
                <td colspan="4" class="text-center py-4 text-gray-500 font-bold">
                    No Products / Items
                </td>
            `;
            tableBody.appendChild(noItemsRow);
        }
    
        function removeNoItemsMessage() {
            const noItemsMessage = document.getElementById("no-items-message");
            if (noItemsMessage) {
                noItemsMessage.remove();
            }
        }
    </script>
    
</body>

</html>
