<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Coming Soon</h1>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <form>
                <button class="btn btn-login" type="button"
                    onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                    Masuk
                </button>
            </form>
    
            @auth
            <form class="form-inline my-2 my-lg-0" action="{{ url('logout') }}" method="POST">
                @csrf
                <button class="btn btn-login" type="submit">
                    Keluar
                </button>
            </form>
            @endauth
        </div>
    </div>
    
</body>

</html>
