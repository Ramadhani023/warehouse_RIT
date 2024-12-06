<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | User Management</title>
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
        <div class="mx-4 sm:mx-6 md:mx-10 lg:mx-14 xl:mx-28 text-black">
            <h1 class="text-2xl mb-4 font-bold">User Management</h1>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">#</th>
                            <th class="px-4 py-2 border border-gray-300">Name</th>
                            <th class="px-4 py-2 border border-gray-300">Email</th>
                            <th class="px-4 py-2 border border-gray-300">Role</th>
                            <th class="px-4 py-2 border border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border border-gray-300">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->role }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"
                                        class="bg-blue-500 text-white px-3 py-2 rounded">Edit</a>
                                    <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}"
                                        method="POST" class="delete-form" data-name="{{ $user->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-2 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

        document.addEventListener('DOMContentLoaded', () => {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                const userName = this.dataset.name;
                const confirmation = confirm(`Are you sure you want to delete ${userName}?`);
                if (!confirmation) {
                    e.preventDefault();
                }
            });
        });
    });
    </script>
</body>

</html>
