<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    @vite('resources/css/app.css')
</head>
<body>
    <?php $current_page = basename($_SERVER['PHP_SELF']);?>
    <nav class="bg-Bluish fixed w-full z-40 " style="top: 0;">
        <div class=" flex flex-wrap justify-between items-center mx-auto p-4 ">
            <h1 class="text-4xl text-white">Warehouse</h1>

            <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg hover:bg-transparent focus:outline-none focus:ring-2 focus:ring-gray-200 lg:hidden" aria-controls="mega-menu-full" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            {{-- Navbar menu --}}
            <div id="mega-menu-full" class="hidden w-full md:hidden lg:block lg:w-auto ">
                <ul class="lg:flex lg:flex-row md:p-0 rounded-lg bg-transparent md:space-x-8 md:grid  md:border-0">
                    @if (Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4">USERS</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('warehouse.main') }}" class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4">WAREHOUSE</a>
                    </li>
                    <li>
                        <a href="{{route('invoice.show')}}" class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4">INVOICE</a>
                    </li>
                    <li>
                        <a href="/profile" class="block py-2 px-3 text-white rounded hover:text-slate-300 md:p-4">PROFILE</a>
                    </li>
                    @if(Route::is('profile.main'))
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="">
                                @csrf
                                <button type="submit" class="block py-2 px-3 text-black font-semibold bg-slate-300  rounded hover:text-red-600 md:p-4">
                                     Logout
                                </button>
                            </form>
                            
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.querySelector("[data-collapse-toggle]");
            const menu = document.getElementById("mega-menu-full");

            toggleButton.addEventListener("click", function() {
                menu.classList.toggle("hidden");
                menu.classList.toggle("md:hidden");
            });
        });
    </script>

</body>
</html>