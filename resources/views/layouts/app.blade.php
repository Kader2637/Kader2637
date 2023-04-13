
<html>
<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/path/to/style.css">
</head>
<body>
    <style>
        body {
            background: linear-gradient(to right, #22b2b2, #A52A2A);
            font-family: 'Segoe UI', sans-serif;
            }
            .text-3d {
                text-shadow: 1px 1px 0px #fff, 2px 2px 0px rgba(0,0,0,0.15), 3px 3px 0px rgba(0,0,0,0.1), 4px 4px 0px rgba(0,0,0,0.05), 5px 5px 0px rgba(0,0,0,0.025);
              }
              .card.shadow {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
              }
              .card.wider {
                width: 100%;
            }


    </style>
<div class="container" style="padding:120px;">
    @yield('content')
</div>

</body>
</html>
