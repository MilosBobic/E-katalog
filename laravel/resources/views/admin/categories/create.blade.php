@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

    <div class="max-w-lg">
        <a href="{{ route('admin.categories.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">← Back</a>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-6">Add Category</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Description (optional)</label>
                    <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-2"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Create Category
                </button>
            </form>
        </div>
    </div>

@endsection