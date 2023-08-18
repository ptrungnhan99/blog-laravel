<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Site Metas -->
<title>@yield('title')</title>
@yield('seo')
<!-- Site Icons -->
@include('client.layouts.header')
</head>

<body>

    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="{{ asset('client/images/version/tech-logo.png') }}"
                            alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            @if (!empty($topNavItems))
                                @foreach ($topNavItems as $nav)
                                    @if (!empty($nav->children[0]))
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @if ($nav->name == null)
                                                    {{ $nav->title }}
                                                @else
                                                    {{ $nav->name }}
                                                @endif
                                                <ul class="sub-menu">
                                                    @foreach ($nav->children[0] as $childNav)
                                                        @if ($childNav->type == 'custom')
                                                            <li class="nav-item"><a class="nav-link"
                                                                    href="{{ $childNav->slug }}" target="_blank">
                                                                    @if ($childNav->name == null)
                                                                        {{ $childNav->title }}
                                                                    @else
                                                                        {{ $childNav->name }}
                                                                    @endif
                                                                </a></li>
                                                        @elseif($childNav->type == 'category')
                                                            <li class="nav-item"><a class="nav-link"
                                                                    href="{{ url($childNav->slug) }}">
                                                                    @if ($childNav->name == null)
                                                                        {{ $childNav->title }}
                                                                    @else
                                                                        {{ $childNav->name }}
                                                                    @endif
                                                                </a></li>
                                                        @else
                                                            <li class="nav-item"><a class="nav-link"
                                                                    href="{{ url($childNav->slug) }}">
                                                                    @if ($childNav->name == null)
                                                                        {{ $childNav->title }}
                                                                    @else
                                                                        {{ $childNav->name }}
                                                                    @endif
                                                                </a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </a>
                                        </li>
                                    @else
                                        @if ($nav->type == 'custom')
                                            <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                                                    target="_blank">
                                                    @if ($nav->name == null)
                                                        {{ $nav->title }}
                                                    @else
                                                        {{ $nav->name }}
                                                    @endif
                                                </a></li>
                                        @elseif($nav->type == 'category')
                                            <li class="nav-item"><a class="nav-link" href="{{ url($nav->slug) }}">
                                                    @if ($nav->name == null)
                                                        {{ $nav->title }}
                                                    @else
                                                        {{ $nav->name }}
                                                    @endif
                                                </a></li>
                                        @else
                                            <li class="nav-item"><a class="nav-link" href="{{ url($nav->slug) }}">
                                                    @if ($nav->name == null)
                                                        {{ $nav->title }}
                                                    @else
                                                        {{ $nav->name }}
                                                    @endif
                                                </a></li>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->

        @yield('content')

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="widget">
                            <div class="footer-text text-left">
                                <a href="index.html"><img src="images/version/tech-footer-logo.png" alt=""
                                        class="img-fluid"></a>
                                <p>Tech Blog is a technology blog, we sharing marketing, news and gadget articles.</p>
                                <div class="social">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i
                                            class="fa fa-twitter"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i
                                            class="fa fa-instagram"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom"
                                        title="Google Plus"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i
                                            class="fa fa-pinterest"></i></a>
                                </div>

                                <hr class="invis">

                                <div class="newsletter-widget text-left">
                                    <form class="form-inline">
                                        <input type="text" class="form-control"
                                            placeholder="Enter your email address">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                    </form>
                                </div><!-- end newsletter -->
                            </div><!-- end footer-text -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Categories</h2>
                            <div class="link-widget">
                                <ul>
                                    <li><a href="#">Marketing <span>(21)</span></a></li>
                                    <li><a href="#">SEO Service <span>(15)</span></a></li>
                                    <li><a href="#">Digital Agency <span>(31)</span></a></li>
                                    <li><a href="#">Make Money <span>(22)</span></a></li>
                                    <li><a href="#">Blogging <span>(66)</span></a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Copyrights</h2>
                            <div class="link-widget">
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Advertising</a></li>
                                    <li><a href="#">Write for us</a></li>
                                    <li><a href="#">Trademark</a></li>
                                    <li><a href="#">License & Help</a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <div class="copyright">&copy; Tech Blog. Design: <a href="http://html.design">HTML Design</a>.
                        </div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop">Scroll to Top</div>

    </div><!-- end wrapper -->
    @include('client.layouts.script')
</body>

</html>
