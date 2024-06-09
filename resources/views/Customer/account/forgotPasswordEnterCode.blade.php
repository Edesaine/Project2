<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enter code</title>
</head>
<body>
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
<div class="container">
    <form method="post" action="{{route('Customer.forgotPassword.checkCode')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
    <h2>Enter the code</h2>
    <p>
        We emailed you the 6 digit code to ypur email <br/>
        Enter the code below to change your password !
    </p>

        <label for="reset_code" class="form-label">Enter the code in your email: </label>
        <div class="code-container">
            <input type="text" class="form-control" id="reset_code" name="reset_code" value="">
    </div>
        @if ($errors->has('reset_code'))
            @foreach ($errors->get('reset_code') as $error)
                <span class="text-danger fs-7">{{ $error }}</span>
            @endforeach
        @endif

    <div>
        <button class="btn btn-primary">Verify</button>
    </div>

    <small class="info">
        If you didn't receive a code !! <strong><a href="{{route('Customer.forgotPassword')}}">RESEND</a></strong>
    </small>

    </form>
</div>

<script>
    const codes = document.querySelectorAll('.code')

    codes[0].focus()

    codes.forEach((code, idx) => {
        code.addEventListener('keydown', (e) => {
            if(e.key >= 0 && e.key <=9) {
                codes[idx].value = ''
                setTimeout(() => codes[idx + 1].focus(), 10)
            } else if(e.key === 'Backspace') {
                setTimeout(() => codes[idx - 1].focus(), 10)
            }
        })
    })
</script>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-image: linear-gradient(142deg,#9861c2, #5cc0de);
        font-family: "Lato", sans-serif;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 0;
    }

    .container{
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        padding: 30px;
        max-width: 1000px;
        text-align: center;
    }

    .code-container{
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px 0;
    }

    .code{
        caret-color: transparent;
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 10px;
        border: 1px solid #eee;
        font-size: 30px;
        font-family: "Lato", sans-serif;
        width: 75px;
        height: 80px;
        margin: 10px;
        text-align: center;
        font-weight: 300;
    }

    @media (max-width: 600px) {
        .code-container{
            flex-wrap: wrap;
        }
        .code{
            font-size: 24px;
            height: 50px;
            max-width: 50px;
            font-size: bold;
        }
    }

    .code::-webkit-outer-spin-button,
    .code::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .code:valid {
        border-color: #9861c2;
        box-shadow: 0 10px 10px -5px rgba(0, 0, 0, 0.25);
    }

    .btn{
        font-family: "Lato", sans-serif;
        min-width: 400px;
        display: inline-block;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        cursor: pointer;
        border: 1px solid transparent;
        margin: 0px 0px 20px 0px;
        padding: 0.775rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: 0.7;
    }

    .btn-primary{
        color: #fff;
        background-color: #9861c2;
        border-color: #9861c2;
    }
</style>
</body>
</html>
