<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="bg-slate-100 h-screen flex items-center justify-center">
        <div class="md:w-96 w-72 border-2 border-Bluish md:p-10 p-6 rounded-xl shadow-2xl bg-white">
            <h1 class="text-3xl md:text-4xl text-center md:mb-16 mb-10">LOGIN</h1>

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

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col space-y-10">
                    <!-- Email Input -->
                    <input type="text" class="border-b border-slate-400 w-full p-2" name="email" placeholder="Email" required autofocus>
                    <!-- Password Input -->
                    <input type="password" class="border-b border-slate-400 w-full p-2" name="password" placeholder="Password" required>
                </div>
                
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="w-4/5 bg-Bluish p-4 rounded-lg shadow-xl">
                        <p class="text-xl">LOG IN</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
