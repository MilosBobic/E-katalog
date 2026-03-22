<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 border-b border-gray-700">
                <a href="{{ route('home') }}" class="text-blue-400 font-bold text-xl">eKatalog</a>
                <p class="text-gray-400 text-sm mt-1">Admin Panel</p>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.products*') ? 'bg-gray-700' : '' }}">
                    📦 Proizvodi
                </a>
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.categories*') ? 'bg-gray-700' : '' }}">
                    🗂️ Kategorije
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.orders*') ? 'bg-gray-700' : '' }}">
                    🛒 Porudžbine
                </a>
            </nav>

            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-700 text-gray-400">
                        🚪 Odjavite se
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow px-8 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-700">@yield('title')</h1>
                <span class="text-gray-500 text-sm">{{ auth()->user()->name }}</span>
            </header>

            <main class="flex-1 p-8">
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>