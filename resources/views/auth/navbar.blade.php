<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Tugas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>

    <style>
        .custom-orange-navbar{
            background-color: #FF4500;

        }
    </style>

    <nav class="navbar sticky-top navbar-expand-lg bg-dark">
        <div class="container">
          <a class="navbar-brand" style="color: white;">Sistem Informasi Tugas Akhir</a>
        </div>
    </nav>    

    <div class="container mt-5">
        @if(session('error'))
        <div class="alert alert-danger mx-auto">
            {{ session('error') }}
        </div>
        @endif
        @yield('content')
    </div>
       
</body>
</html>