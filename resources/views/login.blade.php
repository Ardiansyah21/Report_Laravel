<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <main style="display: flex; justify-content: center; margin: 8%;">
        <div class="card form-card">
            <h2 style="text-align: center; margin-bottom: 20px;">Login Administrator</h2>
            <form method="POST" action="{{route('login.auth')}}" class="card py-4 px-4">
        @csrf
        @if (Session::get('success'))
             <div class="alert alert-success w-75">
                 {{ Session::get('success') }}
            </div>
            @endif
            @csrf
        @if (Session::get('fail'))
             <div class="alert alert-success w-75">
                 {{ Session::get('fail') }}
            </div>
        @endif
        @if (Session::get('notAllowed'))
             <div class="alert alert-success w-75">
                 {{ Session::get('notAllowed') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
                <div class="input-card">
                    <label for="">Email:</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="input-card">
                    <label for="">Password :</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit">Masuk</button>
                <a href="{{route('index')}}" class="back-btn">Batal</a>
            </form>
        </div>
    </main>
</body>
</html>