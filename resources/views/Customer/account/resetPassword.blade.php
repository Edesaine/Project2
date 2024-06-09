<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Check Password and Confirm Password </title>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
<div class="wrapper">
    <form method="post" action="{{route('Customer.forgotPassword.resetPasswordProcess')}}">
        @csrf
        @method('PUT')
        <h2 style="position: center">Set new password</h2>

        <div class="input-box">
            <label class="form-label">Create new password</label>
            <input type="password" class="form-control" id="exampleInputPassword1"
                   autocomplete="off" name="new_password" minlength="6" required>
        </div>
        @if ($errors->has('new_password'))
            @foreach ($errors->get('new_password') as $error)
                <span class="text-danger fs-7">{{ $error }}</span>
            @endforeach
        @endif

        <div class="input-box">
            <label class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="confirm_new_password"
                   autocomplete="off" name="confirm_new_password"  minlength="6" required>
            <i class="fas fa-eye-slash show"></i>
        </div>
        @if ($errors->has('confirm_new_password'))
            @foreach ($errors->get('confirm_new_password') as $error)
                <span class="text-danger fs-7">{{ $error }}</span>
            @endforeach
        @endif

        <div class="alert">
            <i class="fas fa-exclamation-circle error"></i>
            <span class="text">Enter at least 6 numbers</span>
        </div>
        <button class="btn btn-primary" style="position: center">Set new password</button>
    </form>
</div>

</script>
<style>
    /* Google Font Link */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins" , sans-serif;
    }
    body{
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #4070F4;
        padding: 0 35px;
    }
    .wrapper{
        position: relative;
        background: #fff;
        max-width: 480px;
        width: 100%;
        padding: 35px 40px;
        border-radius: 6px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }
    .input-box{
        position: relative;
        height: 65px;
        margin: 25px 0;
    }
    .input-box input{
        position: relative;
        height: 100%;
        width: 100%;
        outline: none;
        color: #333;
        font-size: 18px;
        font-weight: 500;
        padding: 0 40px 0 16px;
        border: 2px solid lightgrey;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    .input-box input:focus,
    .input-box input:valid{
        border-color: #4070F4;
    }
    .input-box i,
    .input-box label{
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #a6a6a6;
        transition: all 0.3s ease;
    }
    .input-box label{
        left: 15px;
        font-size: 18px;
        font-weight: 400;
        background: #fff;
        padding: 0 6px;
        pointer-events: none;
    }
    .input-box input:focus ~ label,
    .input-box input:valid ~ label{
        top: 0;
        font-size: 14px;
        color: #4070F4;
    }
    .input-box i{
        right: 15px;
        cursor: pointer;
        padding: 8px;
    }
    .alert{
        display: flex;
        align-items: center;
        margin-top: -13px;
    }
    .alert .error{
        color: #D93025;
        font-size: 18px;
        display: none;
        margin-right: 8px;
    }
    .text{
        font-size: 18px;
        font-weight: 400;
        color: #a6a6a6;
    }
    .input-box.button input{
        border: none;
        font-size: 20px;
        color: #fff;
        letter-spacing: 1px;
        background: #4070F4;
        cursor: not-allowed;
    }
    .input-box.button input.active:hover{
        background: #265df2;
        cursor: pointer;
    }

    .input-box.button {
        position: relative;
        height: 65px;
        margin: 25px 0;
    }

    .input-box.button button {
        position: relative;
        height: 100%;
        width: 100%;
        outline: none;
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        padding: 0 40px;
        border: none;
        border-radius: 6px;
        background: #4070F4;
        cursor: not-allowed;
        transition: all 0.3s ease;
    }

    .input-box.button button.active:hover {
        background: #265df2;
        cursor: pointer;
    }

    .input-box.button button:focus {
        border-color: #4070F4;
    }

    .input-box.button button:focus ~ label,
    .input-box.button button:valid ~ label {
        top: 0;
        font-size: 14px;
        color: #4070F4;
    }

    .input-box.button i {
        right: 15px;
        cursor: pointer;
        padding: 8px;
    }

</style>
</body>
</html>
