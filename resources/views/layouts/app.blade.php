<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>eVention Shop</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark site-header">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fab fa-telegram-plane"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Контакты</a>
                    </li>
                </ul>
                <form class="form-inline my-3 my-lg-0 input-group-sm">
                    <input class="form-control mr-sm-1" type="text" placeholder="Поиск" aria-label="Поиск">
                    <button class="btn btn-outline-default btn-sm my-2 my-sm-0" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
                <ul class="navbar-nav mr-0 ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-heart"></i>
                            <span class="badge badge-light">0</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cart-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge badge-light">0</span>
                        </a>
                        <div class="dropdown-menu cart-menu" aria-labelledby="cart-dropdown">
                            <h1>
                                В корзине 0 товаров
                            </h1>
                            <div class="cart-items">
                                <div class="cart-item">
                                    <a href="item.item_url" class="item-image">
                                        <img src="item.item_image">
                                    </a>
                                    <div class="item-info">
                                        <a href="item.item_url" class="remove-item" @click.stop="addItem">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                        <a href="item.item_url">
                                            hello
                                        </a>
                                        <div class="item-info-footer">
                                            <p class="badge badge-light">45 руб.</p>
                                            <div class="count">
                                                <a href="#"><i class="fa fa-minus"></i></a>
                                                <b>3 шт.</b>
                                                <a href="#"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <a href="#" class="btn btn-success btn-sm">Перейти в корзину</a>
                            </div>
                        </div>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.login') }}">
                            <i class="fa fa-user"></i>
                            Личный кабинет
                        </a>
                    </li>
                    @elseguest()
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            {{ Auth::user()->name }} {{ Auth::user()->surname }}
                        </a>
                        <div class="dropdown-menu user-menu" aria-labelledby="user-dropdown">
                            <a class="dropdown-item" href="#">Профиль</a>
                            <a class="dropdown-item" href="/user/logout">Выход</a>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="container">
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">&copy; {{ now()->year }}</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Cool stuff</a></li>
                        <li><a class="text-muted" href="#">Random feature</a></li>
                        <li><a class="text-muted" href="#">Team feature</a></li>
                        <li><a class="text-muted" href="#">Stuff for developers</a></li>
                        <li><a class="text-muted" href="#">Another one</a></li>
                        <li><a class="text-muted" href="#">Last time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Resource</a></li>
                        <li><a class="text-muted" href="#">Resource name</a></li>
                        <li><a class="text-muted" href="#">Another resource</a></li>
                        <li><a class="text-muted" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
