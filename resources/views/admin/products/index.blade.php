@extends('layouts.admin')

@section('title', 'Products')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Proizvodi</h2>
        <a href="{{ route('admin.products.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Dodaj proizvod
        </a>
    </div>

    <div class="bg-white rounded-xl shadow">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b">
                    <th class="p-4">Slika</th>
                    <th class="p-4">Naziv</th>
                    <th class="p-4">Kategorija</th>
                    <th class="p-4">Cena</th>
                    <th class="p-4">Zaliha</th>
                    <th class="p-4">Istaknuto</th>
                    <th class="p-4">Akcije</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($products as $product)
                    <tr>
                        <td class="p-4">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}"
                                     class="w-12 h-12 object-cover rounded-lg" alt="{{ $product->name }}">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                    N/A
                                </div>
                            @endif
                        </td>
                        <td class="p-4 font-semibold">{{ $product->name }}</td>
                        <td class="p-4 text-gray-500">{{ $product->category->name }}</td>
                        <td class="p-4 text-blue-600 font-semibold">RSD {{ number_format($product->price, 2) }}</td>
                        <td class="p-4">
                            <span @class([
                                'px-2 py-1 rounded-full text-xs font-semibold',
                                'bg-green-100 text-green-700' => $product->stock > 0,
                                'bg-red-100 text-red-700' => $product->stock === 0,
                            ])>{{ $product->stock }}</span>
                        </td>
                        <td class="p-4">
                            @if($product->is_featured)
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Da</span>
                            @else
                                <span class="text-gray-400 text-xs">Ne</span>
                            @endif
                        </td>
                        <td class="p-4 flex gap-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="text-blue-500 hover:underline">Izmeni</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-400">Nema dostupnih proizvoda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@php use Illuminate\Support\Facades\Storage; @endphp