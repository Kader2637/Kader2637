<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('icon/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Welcome</title>

    <style>
        body {
            background-color: #f8f8f8fe;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('images/gambar.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;


        }

        .container {
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .logo {
            max-width: 100%;
            margin-bottom: 2rem;
        }

        .title {
            font-size: 3rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #f4e3e3;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            background-color: #47c7d8;
            color: #111111;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            background-color: #FFF;
            color: #333;
            box-shadow: 0px 0px 5px #333;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container">
        <h1 class="title 3d-effect">Welcome to Our Website</h1>
        <div class="btn-container">
            @if (Route::has('login'))
                @auth
                    <form method="HEAD" action="{{ url('/home') }}">
                        @csrf
                        <button type="submit" class="btn">Home</button>
                    </form>
                @else
                    <form method="GET" action="{{ route('login') }}">
                        <button type="submit" class="btn">Log in</button>
                    </form>

                    <form method="GET" action="http://127.0.0.1:8000/signup">
                        <button type="submit" class="btn">Register</button>
                    </form>

                @endauth
            @endif
        </div>
    </div>
</body>

</html>
