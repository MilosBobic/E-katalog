<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eKatalog - @yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <body class="bg-gray-100 min-h-screen">
    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">eKatalog</a>

            <div class="flex gap-6 items-center">
                <a href="{{ route('catalog') }}" class="text-gray-600 hover:text-blue-600">Katalog</a>

                @auth
                    <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-blue-600">
                        Korpa
                        @php
                            $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                        @endphp
                        @if($cartCount > 0)
                            <span class="bg-blue-600 text-white text-xs rounded-full px-2 py-0.5">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-blue-600">Moje porudžbine</a>

                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-purple-600 font-semibold hover:text-purple-800">Admin</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-gray-600 hover:text-red-600">Odjava</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Prijava</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    <div class="max-w-6xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- PAGE CONTENT --}}
    <main class="max-w-6xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="text-center text-gray-400 py-6 mt-10 border-t">
        eKatalog © {{ date('Y') }}
    </footer>

</body>
</html>