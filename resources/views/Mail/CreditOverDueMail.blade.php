<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saral Billing</title>
    <style>
        body {
            background-image: linear-gradient(to bottom,
                    #a8dadc 0%,
                    #a8dadc 50%,
                    #457b9d 50%,
                    #457b9d 100%);
            height: 100vh;
        }

        .cardDiv {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        .pdfButton {
            position: absolute;
            top: 45%;
            left: 35%;
        }

        .card {
            border: 1px solid #ccc;
            background-color: #f4f4f4;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 10px;
        }

        .card-title {
            color: back;
            text-align: center;
            font-weight: bold;
            font-size: 25px;
            margin: 0;
        }

        .button-1 {
            background-color: #457b9d;
            border-radius: 8px;
            border-style: none;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-weight: 500;
            height: 40px;
            line-height: 20px;
            list-style: none;
            margin: 0;
            outline: none;
            padding: 10px 16px;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-1:hover,
        .button-1:focus {
            background-color: #a8dadc;
            color: black;
        }
    </style>

</head>

<body>
    <div class="cardDiv" style="border:1px solid #;">
        <div class="card" style="width: 18rem;width:17cm;height:13cm">
            <center style="font-weight:bold;font-size:35px;background-color:red;padding:5px;color:white">
                SARAL BILLING
            </center>
            <div class="card-body">
                <h5 class="card-title" style="color:rgba(255, 0, 0, 0.761)">SALE OVER DUE ALERT</h5>
                <p class="card-text" style="color:rgb(108, 108, 108)">Hi, {{$name}}</p>
                <p class="card-text" style="color:rgb(108, 108, 108)">Your Credit Due has crossed the due limit so,
                    please kindly pay your due amount as soon as possible.</p>
                <hr>
                <center>
                    <p class="card-text" style="color:rgb(108, 108, 108);font-size:20px;font-weight:bold;">TOTAL DUE
                        AMOUNT</p>
                    <p class="card-text" style="color:rgb(108, 108, 108);font-size:25px;font-weight:bold;"> Rs.
                        {{nepaliCurrencyFormate($balance)}}
                    </p>

                </center>
                <hr>
                <p class="card-text" style="color:rgb(108, 108, 108)">Thank you for choosing puja fancy store for
                    shopping.For Any query contact us.</p>

                <p style="  margin-buttom:0;color:rgb(108, 108, 108)"> This is auto-generated email. Please
                    <span style="font-weight:bold;">do not</span> reply to
                    this email.
                </p>
                <br>
                <p style="margin:0;padding:0%;color:rgb(108, 108, 108)">Thank you for visiting us.</p>
            </div>
        </div>
    </div>
</body>

</html>