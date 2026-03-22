<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Molimo vas da verifikujete vašu email adresu klikom na link koji smo vam poslali. Ako niste dobili email, slobodno zatražite novi.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Novi link za verifikaciju je poslat na vašu email adresu.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Posalji ponovo email za verifikaciju') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Odjavi se') }}
            </button>
        </form>
    </div>
</x-guest-layout>
