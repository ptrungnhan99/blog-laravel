@extends('client.master')
@section('title')
 {{$category->name}}
@endsection
@section('content')
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-star bg-orange"></i> {{$category->name}}</h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">{{$category->name}}</li>
                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-list clearfix">
                        @foreach($posts as $post)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="{{route('single.post', $post->slug)}}" title="">
                                        <img src="{{asset('uploads/post/'. $post->thumbnail)}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{route('single.post', $post->slug)}}" title="">{{$post->title}}</a></h4>
                                <p>{{$post->description}}</p>
                                <small class="firstsmall"><a class="bg-orange" href="{{route('category.post', $category->slug)}}" title="">{{$category->name}}</a></small>
                                <small><a href="tech-single.html" title="">{{$post->created_at->format('d/m/Y')}}</a></small>
                                <small><a href="tech-author.html" title="">by {{$post->author->name}}</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> {{$post->view_counts}}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
                        <hr class="invis">
                        @endforeach
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <h2 class="widget-title">Popular Posts</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                @foreach($popular_posts as $post)
                                <a href="{{route('single.post', $post->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="{{asset('uploads/post/'.$post->thumbnail)}}" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">{{$post->title}}</h5>
                                        <small>{{$post->created_at->format('d/m/Y')}}</small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div><!-- end blog-list -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection