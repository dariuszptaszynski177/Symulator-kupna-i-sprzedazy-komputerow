<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    
        <div class="container">
            <div class="col-12 row d-flex justify-content-between">
                <div class="col-4">
                    <a class="navbar-brand mr-auto" href="#">PositronX</a>
                </div>
                <div class="col-8">
                    <div class="col-12 d-flex justify-content-end">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="col-12 collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Logowanie</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register-user') }}">Rejestracja</a>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="">Komputery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user-resources') }}">Zasoby</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user-simulations') }}">Symulacje</a>
                                    </li>
                                    <?php 
                                        $user = App\Models\User::where('id', '=', Auth::id())->first();
                                        
                                        if($user->is_admin==1)
                                        {
                                            ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{route('admin-view')}}">Panel Admina</a>
                                                </li>
                                            <?php
                                        }
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                                    </li>
                                @endguest
                                </ul>
                            </div>
                                    </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    
    @yield('content')

</body>

</html>