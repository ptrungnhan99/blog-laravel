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
                          <tr class="text-center">
                              <th>
                                  NO
                              </th>
                              <th>
                                  Tên 
                              </th>
                              <th>
                                  Email
                              </th>
                              <th>Role</th>
                              <th>
                                  Chức năng
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
