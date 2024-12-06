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
    <h1 class="text-4xl font-normal text-gray-800 mb-[90px]">WELCOME {{ Auth::user()->name }}!</h1>

    <!-- Card Container -->
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Warehouses Card -->
        <a href="{{ route('warehouse.main') }}" class="flex flex-col md:flex-row items-center justify-center w-60 h-28 bg-[#2980B9] rounded-lg text-white shadow-lg">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/warehouse white.png') }}" alt="Warehouse Icon">
            </div>
            <p class="mt-4 md:mt-0 md:ml-4 text-lg font-medium text-center md:text-left">WAREHOUSES</p>
        </a>

        <!-- Invoice Card -->
        <a href="invoice/invoice" class="flex flex-col md:flex-row items-center justify-center w-60 h-28 bg-[#2C3E50] rounded-lg text-white shadow-lg">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/cover-letter-white.png') }}" alt="Warehouse Icon">
            </div>
            <p class="mt-4 md:mt-0 md:ml-4 text-lg font-medium text-center md:text-left">INVOICE</p>
        </a>

        <!-- Profile Card -->
        <a href="/profile" class="flex flex-col md:flex-row items-center justify-center w-60 h-28 bg-[#27AE60] rounded-lg text-white shadow-lg mb-5">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/userPutih.png') }}" alt="Warehouse Icon">
            </div>
            <p class="mt-4 md:mt-0 md:ml-4 text-lg font-medium text-center md:text-left">PROFILE</p>
        </a>

        <!-- User Management Card -->
        @if (Auth::user()->role === 'admin')
        <a href="/admin/users" class="flex flex-col md:flex-row items-center justify-center w-60 h-28 bg-[#cabd2d] rounded-lg text-white shadow-lg mb-5">
            <div class="flex items-center justify-center w-16 h-16 bg-transparent bg-opacity-20 rounded-full">
                <img src="{{ asset('img/userman.png') }}" alt="Warehouse Icon">
            </div>
            <p class="mt-4 md:mt-0 md:ml-4 text-lg font-medium text-center md:text-left">USER MANAGER</p>
        </a>
        @endif
    </div>
</body>

</html>
