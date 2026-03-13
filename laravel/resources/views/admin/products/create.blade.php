@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

    <div class="max-w-2xl">
        <a href="{{ route('admin.products.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">← Nazad</a>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-6">Dodaj proizvod</h2>
            <form method="POST" action="{{ route('admin.products.store') }}"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-600 mb-1">Naziv</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Kategorija</label>
                    <select name="category_id" class="w-full border rounded-lg px-4 py-2" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Opis</label>
                    <textarea name="description" rows="4"
                              class="w-full border rounded-lg px-4 py-2"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">Cena (RSD)</label>
                        <input type="number" name="price" step="0.01" min="0"
                               class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Zaliha</label>
                        <input type="number" name="stock" min="0" value="0"
                               class="w-full border rounded-lg px-4 py-2" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Slika</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1">
                    <label for="is_featured" class="text-gray-600">Istakni na početnoj stranici</label>
                </div>

                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Kreiraj proizvod
                </button>
            </form>
        </div>
    </div>

@endsection