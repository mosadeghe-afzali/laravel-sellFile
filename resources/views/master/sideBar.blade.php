<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            background-color: #d8b2d1;
            margin: 0px;

        }
        .main{
            display: flex;
        }
    </style>
</head>
<body>
<div class="main">
    <div>
        <a href="{{route('registerPage')}}"><button class="button open-button">عضویت</button></a><br>
        <a href="{{route('loginPage')}}"><button class="button">ورود</button></a><br>
        <a href="{{route('userPanel')}}"><button class="button">پنل کاربر</button></a><br>
        <a href="{{route('files.index')}}"><button class="button">مشاهده فایل</button></a><br>
        <a href="{{route('userFile')}}"><button class="button">آپلود فایل کاربر</button></a><br>
        <a href="{{route('guestFile.create')}}"><button class="button">آپلود فایل مهمان</button></a><br>
    </div>


</div>

</body>

</html>
