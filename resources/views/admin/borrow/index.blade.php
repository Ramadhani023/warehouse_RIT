<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Borrow Management</title>
    @vite('resources/css/app.css')
    <style>
        .border-under {
            display: inline-block;
            border-bottom: 1px solid black;
        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    @include('navbar')

    <section class="relative pt-28">
        <div class="mx-4 sm:mx-6 md:mx-10 lg:mx-14 xl:mx-28 text-black">
            <h1 class="text-2xl mb-4 font-bold">Borrow Management</h1>
            <div class="overflow-auto">
                <table class="table-auto w-full text-left border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">#</th>
                            <th class="px-4 py-2 border border-gray-300">Item</th>
                            <th class="px-4 py-2 border border-gray-300">Quantity</th>
                            <th class="px-4 py-2 border border-gray-300">Borrower</th>
                            <th class="px-4 py-2 border border-gray-300">Status</th>
                            <th class="px-4 py-2 border border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrows as $borrow)
                            <tr class="{{ $borrow->status === 'returned' ? 'bg-green-100' : '' }}">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $borrow->item_name }}</td>
                                <td class="px-4 py-2">{{ $borrow->qty }}</td>
                                <td class="px-4 py-2">{{ $borrow->borrower }}</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 text-xs rounded {{ $borrow->status === 'returned' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 flex gap-2">
                                    @if ($borrow->status !== 'returned')
                                        <form action="{{ route('admin.borrow.return', ['id' => $borrow->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-3 py-2 rounded"
                                                aria-label="Mark {{ $borrow->item_name }} as returned">Return</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.borrow.destroy', ['id' => $borrow->id]) }}" method="POST" class="delete-form" data-name="{{ $borrow->item_name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded"
                                            aria-label="Delete {{ $borrow->item_name }}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No borrow records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    const itemName = this.dataset.name;
                    const confirmation = confirm(`Are you sure you want to delete "${itemName}"?`);
                    if (!confirmation) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>

</html>
