<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    @auth
        <div class="wrapper">
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
            <form action="/logout" method="POST">
               @csrf
               <button type="submit">Logout</button>
           </form>
         </div>
    @else
        <div class="wrapper">
            <div class="title">Login Form</div>
            
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="/login" method="POST">
                @csrf
                <div class="field">
                    <input type="text" name="lemail" required>
                    <label>Email Address</label>
                </div>
                <div class="field">
                    <input type="password" name="lpassword" required>
                    <label>Password</label>
                </div>
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" id="remember-me" name="remember">
                        <label for="remember-me">Remember me</label>
                    </div>
                    
                </div>
                <div class="field">
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">
                    Not a member? <a href="/register">Signup now</a>
                </div>
            </form>
        </div>
    @endauth
</body>
</html>