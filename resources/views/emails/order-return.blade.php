<!DOCTYPE html>
<html>
<head>
    <style>
        .button {
            background-color: #3490dc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Hello! {{$cart->user->name}}</h1>
    <p></p>
    
    <a class="button">Click Here</a>
    
    <p>Thanks,<br>The Team</p>
</body>
</html>