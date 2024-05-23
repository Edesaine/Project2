<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite Knowledge | Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="mainDiv">
    <div class="cardStyle">

                <a href="{{route('profile')}}" >
                <img src="{{asset('images/logo.png')}}" style="width: 500px; height: 130px" />
                </a>
        <form action="{{route('Customer.updatePassword')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <h2 class="formTitle">
                     Change Password
                </h2>

                <div class="inputDiv">
                    <label class="inputLabel" for="old_password">Old Password</label>
                    <input type="password" id="old_password" name="old_password" required>
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="confirm_new_password">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password">
                </div>

                <div class="buttonWrapper">
                    <button type="submit" class="submitButton pure-button pure-button-primary">
                        Change account password
                    </button>
                </div>

        </form>
    </div>
</div>
<style>
    .mainDiv {
        display: flex;
        min-height: 100%;
        align-items: center;
        justify-content: center;
        background-color: #f9f9f9;
        font-family: 'Open Sans', sans-serif;
    }
    .cardStyle {
        width: 500px;
        border-color: white;
        background: #fff;
        padding: 36px 0;
        border-radius: 4px;
        margin: 30px 0;
        box-shadow: 0px 0 2px 0 rgba(0,0,0,0.25);
    }

    .formTitle{
        font-weight: 600;
        margin-top: 20px;
        color: #2F2D3B;
        text-align: center;
    }
    .inputLabel {
        font-size: 12px;
        color: #555;
        margin-bottom: 6px;
        margin-top: 24px;
    }
    .inputDiv {
        width: 70%;
        display: flex;
        flex-direction: column;
        margin: auto;
    }
    input {
        height: 40px;
        font-size: 16px;
        border-radius: 4px;
        border: none;
        border: solid 1px #ccc;
        padding: 0 11px;
    }
    input:disabled {
        cursor: not-allowed;
        border: solid 1px #eee;
    }
    .buttonWrapper {
        margin-top: 40px;
    }
    .submitButton {
        width: 70%;
        height: 40px;
        margin: auto;
        display: block;
        color: #fff;
        background-color: #065492;
        border-color: #065492;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }
    .submitButton:disabled,
    button[disabled] {
        border: 1px solid #cccccc;
        background-color: #cccccc;
        color: #666666;
    }

</style>
</body>
</html>
