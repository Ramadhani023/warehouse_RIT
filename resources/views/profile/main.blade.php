<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="max-h-[450px]">
    @include('navbar')
    <section class="flex md:flex-row flex-col-reverse mx-4 md:mx-20 mt-32 justify-center md:justify-between md:gap-14">
        {{-- MODAL EDIT --}}
        <div id="edit-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
            <div id="modal-edit" class="relative flex items-center justify-center h-auto z-40">
                <div class="bg-white p-6 rounded-b-md shadow-lg sm:w-96 w-64">
                    <h2 class="text-xl mb-4 text-black font-semibold">EDIT PROFILE</h2>
                    <form id="edit-form" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="my-8">
                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                class="mt-1 p-2 border-under w-full text-black border-b-2 border-black rounded-lg" placeholder="Name" required>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="mt-1 p-2 border-under w-full text-black border-b-2 border-black rounded-lg" placeholder="Email" required>
                            <input type="date" name="dob" value="{{ Auth::user()->dob }}"
                                class="mt-1 p-2 border-under w-full text-black border-b-2 border-black rounded-lg" required>
                        </div>
                        <div class="flex justify-between">
                            <button id="close-edit" type="button" class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">CANCEL</button>
                            <button type="submit" class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">EDIT</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>

        {{-- MODAL DELETE --}}
        <div id="delete-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
            <div id="modal-delete" class="relative flex items-center justify-center h-auto z-40">
                <div class="bg-white p-6 rounded-b-md shadow-lg sm:w-96 w-64">
                    <h2 class="text-xl mb-20 mt-4 text-black font-semibold text-center">DELETE PROFILE?</h2>
                    <form id="delete-form" action="{{ route('profile.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="password" name="password" placeholder="Enter your password"
                            class=" p-2 border-under mb-10 w-full text-black border-b-2 border-black rounded-lg" required>
                        <div class="flex justify-between">
                            <button id="close-delete" type="button" class="px-3 py-2 bg-gray-300 text-black rounded-lg font-bold">CANCEL</button>
                            <button type="submit" class="px-3 py-2 bg-gray-300 text-black rounded-lg font-bold">DELETE</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div
            class="bg-Mid-blue text-white w-full md:mt-0 mt-20 md:w-[40rem] h-auto p-4 rounded-xl max-h-[450px] overflow-y-auto">
            <p class="text-xl md:text-2xl mt-4 ">Warehouse(s) you can access</p>
            @foreach ($warehouses as $data)
                <div class="mt-4 flex items-center px-4">
                    <img src="{{ asset('img/GUDANG.png') }}" alt="" class="w-20 md:w-4/12">
                    <p class="text-lg md:text-xl mx-4">{{ $data->warehouse_name }}</p>
                </div>
            @endforeach
        </div>

        <div class="w-full md:w-[50rem] h-auto max-h-[425px]" id="desc">
            <div class="flex flex-col md:flex-row gap-4 relative items-center">
                <div
                    class="absolute md:static -top-14 w-auto md:w-64 md:border-2 border-slate-400 rounded-full md:rounded-lg md:p-4 shadow-none md:shadow-xl h-60 max-h-60">
                    <img src="{{ asset('img/user.png') }}" alt="Profile Img" id="profileImg"
                        class="w-20 md:w-auto rounded-full md:rounded-none">
                </div>

                <div class="w-full md:w-2/3 border-2 border-slate-400 rounded-lg p-4 shadow-xl h-auto md:h-60 max-h-60"
                    id="dataUser">
                    <p class="p-2 border-b-4 text-xl">{{ Auth::user()->name }}</p>
                    <p class="p-2 border-b-4 text-xl">{{ Auth::user()->email }}</p>
                    <p class="p-2 border-b-4 text-xl">{{ Auth::user()->dob }}</p>
                    <div class="flex gap-8 mt-8">
                        <button class="open-edit bg-green-600 w-1/2 py-1 rounded-xl"><i class="fa-solid fa-pen"></i>
                            Edit</button>
                        <button class="open-delete bg-red-600 w-1/2 py-1 rounded-xl"><i class="fa-solid fa-trash"></i>
                            Hapus</button>
                    </div>
                </div>
            </div>

            <div class="border-2 border-slate-400 rounded-lg p-1 w-full shadow-xl mt-4">
                <p class="h-40 overflow-y-scroll">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis, dolorum ipsum. Fuga
                    consequuntur culpa blanditiis eveniet ex officiis.
                </p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Modal for EDIT
            const openEdit = document.querySelectorAll('.open-edit');
            const closeEdit = document.getElementById('close-edit');
            const editOverlay = document.getElementById('edit-overlay');

            // Modal for DELETE
            const openDelete = document.querySelectorAll('.open-delete');
            const closeDelete = document.getElementById('close-delete');
            const deleteOverlay = document.getElementById('delete-overlay');

            // Edit Modal
            openEdit.forEach(button => {
                button.addEventListener('click', () => {
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

            // Delete Modal
            openDelete.forEach(button => {
                button.addEventListener('click', () => {
                    deleteOverlay.classList.remove('hidden');
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
        });
    </script>
</body>

</html>
