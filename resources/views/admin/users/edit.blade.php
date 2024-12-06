<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Edit User</title>
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
            <h1 class="text-2xl mb-4 font-bold">Edit User</h1>
            <div class="bg-white p-6 rounded-md border-2 border-gray-300 mb-5 shadow-lg lg:w-1/3 md:w-2/3 sm:w-2/3">
                <h2 class="text-xl mb-4 text-black border-under">Edit User</h2>
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="my-4">
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="border border-gray-300 mt-1 p-2 w-full text-black" required>
                    </div>

                    <div class="my-4">
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="border border-gray-300 mt-1 p-2 w-full text-black" required>
                    </div>

                    <div class="my-4">
                        <label for="role" class="block text-sm font-bold text-gray-700 mb-1">Role</label>
                        <select id="role" name="role"
                            class="border border-gray-300 mt-1 p-2 w-full text-black" required>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-2 bg-gray-300 text-black rounded-lg font-bold">Cancel</a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg font-bold">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html>
