<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <title>shortUrl</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Shorten your URL.</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <form action="{{ url('make') }}" method="post">
            {{ csrf_field() }}
            <input type="text" name="url" placeholder="ENTER your URL" >
            <input type="submit" value="Shorten">
        </form>


        @if(!empty($shortenUrl))
            <h2>Your shorten URI is</h2>
            <a href="{{$shortenUrl}}"> {{$shortenUrl}} </a>
        @endif
        @if(!empty($notFound))
            <h2>{{$notFound}}</h2>
        @endif
    </div>
</body>
</html>