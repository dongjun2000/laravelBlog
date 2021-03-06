<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @hasSection('title')
        <title>@yield('title') - {{config('app.name')}}</title>
    @else
        <title>{{config('app.name')}}</title>
    @endif
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/pjax/pjax.css')}}">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="/">编程故事</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/">首页 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.index')}}">用户列表</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">更多</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Action 1</a>
                        <a class="dropdown-item" href="#">Action 2</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline mr-auto my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div class="my-2 my-lg-0">
                @auth
                    <a href="{{ route('user.show', auth()->user()) }}" class="btn btn-info btn-sm float-left m-1">我的主页</a>
                    <a href="{{ route('user.edit', auth()->user()) }}" class="btn btn-success btn-sm float-left m-1">修改信息</a>
                    <form class="float-left" action="{{ route('logout') }}" method="post">
                        @csrf
                    <button type="submit" href="{{ route('logout') }}" class="btn btn-danger btn-sm m-1">退出</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-sm float-left m-1">登录</a>
                    <a href="{{ route('user.create') }}" class="btn btn-danger btn-sm float-left m-1">注册</a>
                @endauth
            </div>
        </div>
    </nav>
</div>

<div class="container" id="pjax-container">
    <!--pjax加载动画-->
    <div id="loading">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
    <!--pjax加载动画 结束-->

    @include('layouts._error')

    @include('layouts._message')

    @yield('content')

</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script src="{{asset('plugin/pjax/pjax.js')}}"></script>

@yield('script')

<script>
    // 3秒后自动关闭系统消息提示框
    if ($('.alert').length > 0) {
        setTimeout(function() {
            console.log(111)
            $('.alert').alert('close');
        }, 3000);
    }
</script>

</body>
</html>