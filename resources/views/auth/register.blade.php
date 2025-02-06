<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    @vite('resources/css/app.css')
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }
    </style>
</head>

<body class="bg-gradient h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 mx-4">
        <h1 class="text-2xl md:text-3xl font-bold text-center mb-6 text-Bluish">Create an Account</h1>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Register Form -->
        <form method="POST" action="{{ route('registeradminonly') }}">
            @csrf
            <div class="space-y-4 my-10">
                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        placeholder="Enter your full name" required autofocus>
                </div>

                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        placeholder="Enter a username" required>
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        placeholder="Enter your email" required>
                </div>

                <!-- Date of Birth Input -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" id="dob" name="dob"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        required>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        placeholder="Enter a password" required>
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        placeholder="Confirm your password" required>
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                    <select id="role" name="role"
                        class="w-full mt-1 border border-gray-300 rounded-lg p-3 focus:ring-Bluish focus:border-Bluish"
                        required>
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-Bluish hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                    REGISTER
                </button>
            </div>
        </form>
    </div>
</body>

</html>
