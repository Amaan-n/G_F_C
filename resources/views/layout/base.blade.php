<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Dashboard')</title>
    @stack('style')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        aside {
            background-color: #f4f4f4;
            padding: 20px;
            height: calc(100vh - 40px);
            border-right: 1px solid #ddd; /* Add border for better separation */
        }
        
        main {
            padding: 20px;
            height: calc(100vh - 40px);
            overflow-y: auto;
        }

        nav ul {
            padding: 0;
            list-style: none;
        }

        nav ul li {
            margin-bottom: 10px;
        }

        nav ul li a {
            color: grey;
            display: block;
            text-decoration: none;
            padding: 10px 0;
        }

        nav ul li a:hover {
            color: #000;
            font-weight: bold;
            background-color: #ebe3e3; 
            border-radius: 1rem;
        }
        #nova{
            color: rgb(87, 79, 79);
        }

        .active a {
            color: #fff;
            font-weight: bold;
            background-color: #19508a;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>  
    <header>
        <h1>Activity Logs Demo</h1>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <aside>
                    <nav>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link "  id='nova' href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link " id='nova' href="{{ route('grand.show')}}">Grand Father</a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link "  id='nova' href="{{ route('father.show')}}">Father</a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" id='nova' href="{{ route('child.show')}}">Child</a>
                            </li> 
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link " id='nova' href="{{ route('logs.show')}}">Logs List</a>
                            </li> 
                        </ul>
                    </nav>
                </aside>
            </div>
            <div class="col-sm-9">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
@stack('script')
