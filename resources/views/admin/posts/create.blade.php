@extends('admin.master')
@section('content')
    <form class="forms-sample" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <h4 class="card-title">Quản lý Bài viết</h4>
                            </div>
                            <div class="col-3 text-right">
                                <a href="{{ route('posts.index') }}" class="btn btn-primary btn-icon-text">
                                    Trở về
                                </a>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" name="title" class="form-control inputPostTitle"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Đường dẫn</label>
                                    <input type="text" name="slug" class="form-control slugPost"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Miêu tả</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung</label>
                                    <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-check" style="padding-left: 20px">
                                        <input class="form-check-input" type="checkbox" name="highlight" id="highlight"
                                            value="1" @if (old('highlight')) checked @endif>
                                        <label for="highlight">
                                            Highlight
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="category_id">Danh mục bài viết</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Ảnh Thumbnail</label>
                                    <input type="file" name="thumbnail" class="dropify"
                                        data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="#collapseSEO" class="card-title nav-link collapsed" data-toggle="collapse"
                            data-target="#collapseSEO" aria-expanded="false"
                            style="display:flex;justify-content: space-between">
                            <span>
                                Tối ưu SEO
                            </span> <i class="card-tools icon-circle-plus"></i></a>
                        <div id="collapseSEO" class="row mt-3 collapse" style="">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="seo_title" class="">Thẻ Title</label>
                                    <input id="seo_title" class="form-control" name="seo_title" type="text"
                                        value="{{ old('seo_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_canonical" class="">Thẻ Cannonical</label>
                                    <input id="seo_canonical" class="form-control" name="seo_canonical" type="text"
                                        value="{{ old('seo_canonical') }}">
                                </div>
                                <div class="form-group ">
                                    <label for="seo_keyword" class="">Thẻ Meta Keyword</label>
                                    <textarea id="seo_keyword" class="form-control" rows="3" name="seo_keyword" cols="50">{{ old('seo_keyword') }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="seo_desc" class="">Thẻ Meta Description</label>
                                    <textarea id="seo_desc" class="form-control" rows="3" name="seo_desc" cols="50">{{ old('seo_desc') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="post_type" class="">Thẻ Post Type</label>
                                    <input id="post_type" class="form-control" name="post_type" type="text"
                                        value="{{ old('post_type') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_robot" class="">Thẻ Meta Robot</label>
                                    <input id="meta_robot" class="form-control" name="meta_robot" type="text"
                                        value="{{ old('meta_robot') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImages(files);
                    }
                }
            });

            function uploadImages(files) {
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('posts.uploadImages') }}", // Change this to your upload route
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        for (let i = 0; i < response.imageUrls.length; i++) {
                            $('#content').summernote('insertImage', response.imageUrls[i]);
                        }
                    }
                });
            }
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
    <script>
        $(document).on('change', '.inputPostTitle', (e) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();

            let $this = e.target;
            let titlePost = $($this).parents("form").find("input[name='title']").val();
            let formData = new FormData();
            formData.append('title', titlePost);

            $.ajax({
                url: "{{ route('posts.to_slug') }}",
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('.slugPost').val(data.message);

                    } else {
                        alert("Bị lỗi khi nhập title !")
                    }
                }
            })
        })
    </script>
@endsection
