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
                <h4 class="card-title">Thêm danh mục</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <form class="forms-sample" action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" class="form-control">
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
                                <input type="text" name="slug" class="form-control">
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
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Tên danh mục
                                        </th>
                                        <th>
                                            Dường dẫn
                                        </th>
                                        <th>
                                            Chức năng
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        <td>
                                            tin-tuc
                                        </td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary btn-rounded btn-icon m-1" href="{{ route('categories.edit',$category->id) }}" style="line-height: 42px"> <i class="ti-pencil-alt"></i></a>
                                            <form method="post" action="{{route('categories.destroy', $category->id)}}">
                                              @method('delete')
                                              @csrf
                                                <button type="submit" class="btn btn-danger btn-rounded btn-icon m-1">
                                                  <i class="ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @if ($category->children->count() > 0)
                                        @foreach ($category->children as $child)
                                        <tr>
                                            <td>
                                                ---- {{$child->name}}
                                            </td>
                                            <td>
                                                tin-tuc
                                            </td>
                                            <td class="d-flex">
                                                <a class="btn btn-primary btn-rounded btn-icon m-1" href="{{ route('categories.edit',$child->id) }}" style="line-height: 42px"> <i class="ti-pencil-alt"></i></a>
                                                <form method="post" action="{{route('categories.destroy', $child->id)}}">
                                                  @method('delete')
                                                  @csrf
                                                    <button type="submit" class="btn btn-danger btn-rounded btn-icon m-1">
                                                      <i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                     @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection