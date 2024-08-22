<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @extends('link_straps.linkstraps')
</head>

<body>
    <header>
        <div class="collapse navbar-collapse position-absolute start-100 bg-danger" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 bg-success">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="#">Login</a>
                </li>
            </ul>
        </div>
    </header>
    <div class="content container-fluid p-0 m-0">
        @yield('content')
    </div>
</body>

</html>
