@extends('admin.master')
@section('content')
<h1>Categories</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Category Name:</label>
        <input type="text" name="name" required>
        <label for="parent_id">Parent Category (optional):</label>
        <select name="parent_id">
            <option value="">None</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit">Create Category</button>
    </form>
    <hr>
    <h2>Category List</h2>
    @foreach ($categories as $category)
        <h3>{{ $category->name }}</h3>
        @if ($category->children->count() > 0)
            <ul>
                @foreach ($category->children as $child)
                    <li>{{ $child->name }}</li>
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection