@extends('admin.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-9">
                      <h4 class="card-title">Quản lý User</h4>
                  </div>
                  <div class="col-3 text-right">
                      <a href="{{ route('users.create') }}" class="btn btn-primary btn-icon-text">
                          <i class="ti-plus btn-icon-prepend"></i>
                          Thêm user
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
                        @foreach ($data as $key => $user)
                          <tr class="text-center">
                              <td class="py-1">
                                {{++$i}}
                              </td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @if(!empty($user->getRoleNames()))
                                  @foreach($user->getRoleNames() as $v)
                                     <label class="badge badge-success">{{ $v }}</label>
                                  @endforeach
                                @endif
                              </td>
                              <td class="d-flex justify-content-center">
                                <a class="btn btn-primary btn-rounded btn-icon m-1" href="{{ route('users.show',$user->id) }}" style="line-height: 42px"> <i class="ti-eye"></i></a>
                                <a class="btn btn-primary btn-rounded btn-icon m-1" href="{{ route('users.edit',$user->id) }}" style="line-height: 42px"> <i class="ti-pencil-alt"></i></a>
                                <form method="post" action="{{route('users.destroy', $user->id)}}">
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
          </div>
      </div>
  </div>
</div>
@endsection
