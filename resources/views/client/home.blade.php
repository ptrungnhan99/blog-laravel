@extends('client.master')
@section('title')
 Tin Tức - Xe Điện
@endsection
@section('content')
<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
            @foreach($highlights as $key => $post)
            @if($key == 0)
                <div class="first-slot">
            @elseif($key == 1)
                <div class="second-slot">
            @elseif($key == 2)
                <div class="last-slot">
            @endif
                <div class="masonry-box post-media">
                     <img src="{{asset('uploads/post/'. $post->thumbnail)}}" alt="{{$post->title}}" class="img-fluid">
                     <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="{{route('category.post', $post->category->slug)}}" title="">{{$post->category->name}}</a></span>
                                <h4><a href="{{route('single.post', $post->slug)}}" title="">{{$post->title}}</a></h4>
                                <small><a href="tech-single.html" title="">{{$post->created_at->format('d/m/Y')}}</a></small>
                                <small><a href="tech-author.html" title="">{{$post->author->name}}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-side -->
            @endforeach
        </div><!-- end masonry -->
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->

                    <div class="blog-list clearfix">
                        @foreach($posts as $post)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('uploads/post/' . $post->thumbnail)}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{route('single.post', $post->slug)}}" title="">{{$post->title}}</p>
                                <small class="firstsmall"><a class="bg-orange" href="{{route('category.post', $post->category->slug)}}" title="">{{$post->category->name}}</a></small>
                                <small><a href="#" title="">{{$post->created_at->format('d/m/Y')}}</a></small>
                                <small><a href="#" title="">by {{$post->author->name}}</a></small>
                                <small><a href="#" title=""><i class="fa fa-eye"></i> {{$post->view_counts}}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->

                        <hr class="invis">
                        @endforeach
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->
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