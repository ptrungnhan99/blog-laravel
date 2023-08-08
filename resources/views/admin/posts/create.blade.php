@extends('admin.master')
@section('content')
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
              <form class="forms-sample" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" class="form-control inputPostTitle" value="{{old('title')}}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Đường dẫn</label>
                            <input type="text" name="slug" class="form-control slugPost" value="{{old("slug")}}">
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Miêu tả</label>
                            <textarea name="description" class="form-control" rows="3">{{old("description")}}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{old("content")}}</textarea>
                            @error('content')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check" style="padding-left: 20px">
                                <input class="form-check-input" type="checkbox" name="highlight" id="highlight"
                                    value="1" @if (old('highlight')) checked @endif>
                                <label  for="highlight">
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
            </form>
          </div>
      </div>
  </div>
</div>
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
            let titlePost =  $($this).parents("form").find("input[name='title']").val();
            let formData = new FormData();
            formData.append('title', titlePost);
            
            $.ajax({
                url: "{{ route('posts.to_slug') }}",
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (data) {
                    if(data.success){
                        $('.slugPost').val(data.message);
    
                    }else{
                        alert("Bị lỗi khi nhập title !")
                    }
                }
            })
        })
    </script>
@endsection