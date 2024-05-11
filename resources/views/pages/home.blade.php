<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        #countdown {
            font-size: 1.5em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Coming Soon</h1>
        <div id="countdown">
            <p id="timer"></p>
        </div>
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

    <script>
        // Set the date we're counting down to
        var endDate = new Date("July 31, 2024 23:59:59").getTime();

        // Get today's date and time
        var startDate = new Date("April 27, 2024 00:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {
            var now = new Date().getTime();
            
            // Find the distance between now and the end date
            var distance = endDate - now;

            // If now is less than start date, set distance to full duration
            if (now < startDate) {
                distance = endDate - startDate;
            }
            
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Display the result in the element with id="timer"
            document.getElementById("timer").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";
            
            // If the count down is finished, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
</body>

</html>
