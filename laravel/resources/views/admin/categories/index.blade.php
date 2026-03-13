@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Categories</h2>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Add Category
        </a>
    </div>

    <div class="bg-white rounded-xl shadow">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b">
                    <th class="p-4">Name</th>
                    <th class="p-4">Slug</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($categories as $category)
                    <tr>
                        <td class="p-4 font-semibold">{{ $category->name }}</td>
                        <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="p-4 text-gray-500">{{ $category->description ?? '—' }}</td>
                        <td class="p-4 flex gap-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="text-blue-500 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                                  onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-400">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection