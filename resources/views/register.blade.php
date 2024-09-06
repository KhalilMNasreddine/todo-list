<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form Design | CodeLab</title>
      <link rel="stylesheet" href="{{ asset('css/login.css') }}">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Login Form
         </div>
         <form action="/register" method="POST">
            @csrf
            <div class="field">
                <input type="text" name="name" required>
                <label>Name</label>
             </div>
            <div class="field">
               <input type="text" name="email" required>
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" name="password" required>
               <label>Password</label>
            </div>
            <div class="content">
               <div class="checkbox">
                  <input type="checkbox" id="remember-me" name="remember">
                  <label for="remember-me">Remember me</label>
               </div>
            </div>
            <div class="field">
               <input type="submit" value="Sign Up">
            </div>
            <div class="signup-link">
               Already a member a member? <a href="/">Sign in</a>
            </div>
         </form>
      </div>
   </body>
</html>