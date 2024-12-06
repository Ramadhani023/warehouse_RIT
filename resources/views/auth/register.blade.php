<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-slate-100 h-screen flex items-center justify-center">
        <div class="md:w-96 w-72 border-2 border-Bluish md:p-10 p-6 rounded-xl shadow-2xl bg-white">
            <h1 class="text-3xl md:text-4xl text-center md:mb-16 mb-10">REGISTER</h1>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('registeradminonly') }}">
                @csrf
                <div class="flex flex-col space-y-10">
                    <!-- Name Input -->
                    <input type="text" class="border-b border-slate-400 w-full p-2" name="name"
                        placeholder="Full Name" required autofocus>

                    <!-- Username Input -->
                    <input type="text" class="border-b border-slate-400 w-full p-2" name="username"
                        placeholder="Username" required>

                    <!-- Email Input -->
                    <input type="email" class="border-b border-slate-400 w-full p-2" name="email"
                        placeholder="Email Address" required>

                    <!-- Date of Birth Input -->
                    <input type="date" class="border-b border-slate-400 w-full p-2" name="dob" placeholder="Date of Birth"
                        required>

                    <!-- Password Input -->
                    <input type="password" class="border-b border-slate-400 w-full p-2" name="password"
                        placeholder="Password" required>

                    <!-- Confirm Password Input -->
                    <input type="password" class="border-b border-slate-400 w-full p-2" name="password_confirmation"
                        placeholder="Confirm Password" required>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="w-4/5 bg-Bluish p-4 rounded-lg shadow-xl">
                        <p class="text-xl">REGISTER</p>
                    </button>
                </div>
            </form>

            <!-- Already Registered Link -->
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-700">
                    Already registered?
                </a>
            </div>
        </div>
    </div>
</body>

</html>
