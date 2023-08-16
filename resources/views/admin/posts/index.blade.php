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
                      <a href="{{ route('posts.create') }}" class="btn btn-primary btn-icon-text">
                          <i class="ti-plus btn-icon-prepend"></i>
                          Thêm bài viết
                      </a>
                  </div>
              </div>
              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif
            <div class="table-responsive">
                <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>
                                  Tên bài viết
                              </th>
                              <th>
                                  Danh mục bài viết
                              </th>
                              <th>
                                  Tác giả
                              </th>
                              <th>Trạng thái</th>
                              <th>Ngày đăng</th>
                              <th>
                                  Chức năng
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->category->name}}</td>
                                <td>{{$post->author->name}}</td>
                                <td>
                                    <div class="badge rounded-pill @if($post->approved === 1)  {{'badge-success' }} @else {{'badge-danger' }} @endif p-2 text-uppercase px-3">
                                        {{ $post->approved  === 1 ? 'Đã duyệt' : 'Chưa duyệt'  }}
                                    </div>
                                </td>
                                <td>{{$post->created_at->format('d/m/Y')}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-primary btn-rounded btn-icon m-1" href="{{ route('posts.edit',$post->id) }}" style="line-height: 42px"> <i class="ti-pencil-alt"></i></a>
                                    <form method="post" action="{{route('posts.destroy', $post->id)}}">
                                      @method('delete')
                                      @csrf
                                        <button type="submit" class="btn btn-danger btn-rounded btn-icon m-1">
                                          <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
            </div>
            {{ $posts->links() }}
          </div>
      </div>
  </div>
</div>
@endsection
