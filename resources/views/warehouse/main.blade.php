<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse | Warehouse</title>
    @vite('resources/css/app.css')
    <style>
        .border-under {
            display: inline-block;
            border-bottom: 1px solid black;

        }
    </style>
</head>

<body>
    @include('navbar')

    <section class="relative pt-28">
        <div
            class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-4 my-4 md:my-2 mx-4 sm:mx-6 md:mx-10 lg:mx-14 xl:mx-28 text-white">
            @if ($warehouse->isEmpty())
                <p>No warehouses available.</p>
            @else
                @foreach ($warehouse as $data)
                    <a href="{{ route('warehouse.showi', ['id' => $data->id]) }}">
                        <div class="bg-Mid-blue rounded-lg py-6 px-4 md:py-8 md:px-4 flex flex-col items-center">
                            <div class="w-32 sm:w-40 md:w-52 flex justify-center items-center mb-4">
                                <img src="{{ asset('img/GUDANG.png') }}" alt="warehouse Icon" class="max-w-full h-auto">
                            </div>
                            <div class="text-xl sm:text-2xl md:text-3xl">{{ $data->warehouse_name }}</div>
                        </div>
                    </a>
                @endforeach
            @endif


            <button id="open-modal" class="bg-Mid-blue rounded-lg py-6 px-4 md:py-8 md:px-4 flex flex-col items-center">
                <div class="w-32 sm:w-40 md:w-52 flex justify-center items-center mb-2 ">
                    <img src="{{ asset('img/plus.png') }}" alt="Tambah Warehouse">
                </div>
            </button>

            <!-- Modal Structure -->
            <div id="modal-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 hidden">
                <div id="modal"
                    class="relative flex items-center justify-center h-auto md:m-8 z-40 lg:top-14 md:top-9 top-16 ">
                    <div class="bg-white p-6 rounded-b-md shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                        <h2 class="text-xl mb-4 text-black border-under">ADD WAREHOUSE</h2>
                        <form action="{{ route('warehouse.add') }}" method="post">
                            @csrf
                            <div class="my-4">
                                <input type="text" id="name" name="warehouse_name" placeholder="Warehouse Name"
                                    class="border-under mt-1 p-2 w-full text-black" required>
                            </div>
                            <div class="flex justify-between">
                                <button id="close-modal" type="button"
                                    class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">CANCEL</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">ADD</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openModalBtn = document.getElementById('open-modal');
            const modalOverlay = document.getElementById('modal-overlay');
            const closeModalBtn = document.getElementById('close-modal');

            openModalBtn.addEventListener('click', () => {
                modalOverlay.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', () => {
                modalOverlay.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === modalOverlay) {
                    modalOverlay.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
