@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="title mb-4">Danh mục</h2>
    </div>
    <div class="col-12">
        @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        @if (session('alert'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
        @endif
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa danh mục</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <form class="forms-sample" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('name') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="slug">Đường dẫn</label>
                                <input type="text" name="slug" class="form-control" value="{{$category->slug}}">
                                @if (count($errors) > 0)
                                <small class="text-danger">
                                    @foreach ($errors->get('slug') as $message)
                                        {{ $message }} <br>
                                    @endforeach
                                </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent Category (optional):</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($categories as $category_parent)
                                        <option value="{{ $category_parent->id }}" @if($category->parent_id == $category_parent->id) selected @endif>{{ $category_parent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                    @if ($category->thumbnail)
                                    <input type="file" name="thumbnail" class="dropify"
                                    data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M"
                                    data-default-file="{{ asset('uploads/category/' . $category->thumbnail) }}">
                                    @else
                                    <input type="file" name="thumbnail" class="dropify"
                                    data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M">
                                    @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                },
                error: {
                    'fileSize': 'The file size is too big > 2M.',
                    'imageFormat': 'The image format is not allowed only jpg png jpeg.'
                }
            });
        });
    </script>
@endsection