<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <!-- Welcome Text -->
    <h1 class="text-4xl font-normal text-gray-800 mb-12">WELCOME {{ Auth::user()->name }}!</h1>

    <!-- Card Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
        <!-- Warehouses Card -->
        <a href="{{ route('warehouse.main') }}" class="flex flex-col items-center justify-center w-60 h-28 bg-[#2980B9] rounded-lg text-white shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/warehouse white.png') }}" alt="Warehouse Icon">
            </div>
            <p class="mt-2 text-lg font-medium">WAREHOUSES</p>
        </a>

        <!-- Invoice Card -->
        <a href="invoice/invoice" class="flex flex-col items-center justify-center w-60 h-28 bg-[#2C3E50] rounded-lg text-white shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/cover-letter-white.png') }}" alt="Invoice Icon" width="80%" class="mt-1">
            </div>
            <p class="mt-2 text-lg font-medium">INVOICE</p>
        </a>

        <!-- Profile Card -->
        <a href="/profile" class="flex flex-col items-center justify-center w-60 h-28 bg-[#27AE60] rounded-lg text-white shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/userPutih.png') }}" alt="Profile Icon">
            </div>
            <p class="mt-2 text-lg font-medium">PROFILE</p>
        </a>

        <!-- User Management Card (Visible only for Admin) -->
        @if (Auth::user()->role === 'admin')
        <a href="{{ route('admin.borrow.index') }}" class="flex flex-col items-center justify-center w-60 h-28 bg-[#cabd2d] rounded-lg text-white shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/userman.png') }}" alt="User  Management Icon" class="ml-3">
            </div>
            <p class="mt-2 text-lg font-medium">BORROW LIST</p>
        </a>

        <!-- Borrow List Card (Visible only for Admin) -->
        <a href="/admin/users" class="flex flex-col items-center justify-center w-60 h-28 bg-[#2dcab0] rounded-lg text-white shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/borrow-list.png') }}" alt="Borrow List Icon" class="ml-3">
            </div>
            <p class="mt-2 text-lg font-medium">USER MANAGER</p>
        </a>
        @endif
    </div>
</body>

</html>