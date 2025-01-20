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

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-green {
            background-color: #4caf50;
            color: #fff;
        }

        .btn-green:hover {
            background-color: #45a049;
        }

        .btn-blue {
            background-color: #2196f3;
            color: #fff;
        }

        .btn-blue:hover {
            background-color: #1976d2;
        }

        .btn-red {
            background-color: #f44336;
            color: #fff;
        }

        .btn-red:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    @include('navbar')

    <section class="relative pt-28">
        <div class="mx-4 sm:mx-6 md:mx-10 lg:mx-14 xl:mx-28 text-black">
            <h1 class="text-2xl mb-4 font-bold">User Management</h1>
            <div class="my-4">
                <a href="{{ route('registeradminonly') }}" class="btn btn-green mb-4">Create User</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-blue">Edit</a>
                                    <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST" class="inline-block delete-form" data-name="{{ $user->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red">Delete</button>
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
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
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
