@extends('client.master')
@section('title')
    {{$post->title}}
@endsection
@section('content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('category.post', $post->category->slug)}}">{{$post->category->name}}</a></li>
                            <li class="breadcrumb-item active">{{$post->title}}</li>
                        </ol>

                        <span class="color-orange"><a href="{{route('category.post', $post->category->slug)}}" title="">{{$post->category->name}}</a></span>

                        <h1>{{$post->title}}</h1>

                        <div class="blog-meta big-meta">
                            <small><a href="#" title="">{{$post->created_at->format('d/m/Y')}}</a></small>
                            <small><a href="#" title="">by {{$post->author->name}}</a></small>
                            <small><a href="#" title=""><i class="fa fa-eye"></i> {{$post->view_counts}}</a></small>
                        </div><!-- end meta -->
                    </div><!-- end title -->

                    <div class="blog-content">  
                       {!!$post->content!!}
                    </div><!-- end content -->

                    <hr class="invis1">

                    <div class="custombox prevnextpost clearfix">
                        <div class="row">
                            @if($post->previous())
                            <div class="col-lg-6">
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="{{route('single.post', $post->previous()->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between text-right">
                                                <img src="{{asset('uploads/post/'. $post->previous()->thumbnail)}}" alt="" class="img-fluid float-right">
                                                <h5 class="mb-1">{{$post->previous()->title}}</h5>
                                                <small>Prev Post</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            @endif
                            @if($post->next())
                            <div class="col-lg-6">
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="{{route('single.post', $post->next()->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{asset('uploads/post/'. $post->next()->thumbnail)}}" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">{{$post->next()->title}}</h5>
                                                <small>Next Post</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            @endif
                        </div><!-- end row -->
                    </div><!-- end author-box -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">Có thể bạn sẽ thích</h4>
                        <div class="row">
                            @foreach($related as $post)
                            <div class="col-lg-6">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{route('single.post', $post->slug)}}" title="">
                                            <img src="{{asset('uploads/post/'. $post->thumbnail)}}" alt="" class="img-fluid">
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta">
                                        <h4><a href="{{route('single.post', $post->slug)}}" title="">{{$post->title}}</a></h4>
                                        <small><a href="{{route('category.post', $post->category->slug)}}" title="">{{$post->category->name}}</a></small>
                                        <small><a href="blog-category-01.html" title="">{{$post->created_at->format('d/m/Y')}}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                            @endforeach
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <h2 class="widget-title">Popular Posts</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                @foreach($popular_posts as $post)
                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
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