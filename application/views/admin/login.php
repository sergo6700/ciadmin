<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>CodeIgniter Admin Sample Project</title>
    <meta charset="utf-8">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <style>

          @import url('https://fonts.googleapis.com/css?family=Mukta');
          body{
              font-family: 'Mukta', sans-serif;
              height:100vh;
              min-height:550px;
              background-image: url(http://www.planwallpaper.com/static/images/Free-Wallpaper-Nature-Scenes.jpg);
              background-repeat: no-repeat;
              background-size:cover;
              background-position:center;
              position:relative;
              overflow-y: hidden;
          }
          a{
              text-decoration:none;
              color:#444444;
          }
          ::-webkit-scrollbar {
              width: 5px;
          }

          /* Track */
          ::-webkit-scrollbar-track {
              box-shadow: inset 0 0 5px grey;
          }

          /* Handle */
          ::-webkit-scrollbar-thumb {
              background: red;
              border-radius: 10px;
          }

          /* Handle on hover */
          ::-webkit-scrollbar-thumb:hover {
              background: #b30000;
          }

          .login-reg-panel{
              position: relative;
              top: 50%;
              transform: translateY(-50%);
              text-align:center;
              width:70%;
              right:0;left:0;
              margin:auto;
              height:400px;
              background-color: blue; /* For browsers that do not support gradients */
              background-image: linear-gradient(to right, blue ,  red)
          }
          .white-panel{
              background-color: rgba(255,255, 255, 1);
              height:500px;
              position:absolute;
              top:-50px;
              overflow: auto;
              width:50%;
              right:calc(50% - 50px);
              transition:.3s ease-in-out;
              z-index:0;
              box-shadow: 0 0 15px 9px #00000096;
          }
          .login-reg-panel input[type="radio"]{
              position:relative;
              display:none;
          }
          .login-reg-panel{
              color:#B8B8B8;
          }
          .login-reg-panel #label-login,
          .login-reg-panel #label-register{
              border:1px solid #9E9E9E;
              padding:5px 5px;
              width:150px;
              display:block;
              text-align:center;
              border-radius:10px;
              cursor:pointer;
              font-weight: 600;
              font-size: 18px;
          }
          .login-info-box{
              width:30%;
              padding:0 50px;
              top:20%;
              left:0;
              position:absolute;
              text-align:left;
          }
          .register-info-box{
              width:30%;
              padding:0 50px;
              top:20%;
              right:0;
              position:absolute;
              text-align:left;

          }
          .right-log{right:50px !important;}

          .login-show,
          .register-show{
              z-index: 1;
              display:none;
              opacity:0;
              transition:0.3s ease-in-out;
              color:#242424;
              text-align:left;
              padding:50px;

          }
          .show-log-panel{
              display:block;
              opacity:0.9;
          }
          .login-show input[type="text"], .login-show input[type="password"] {
              width: 100%;
              display: block;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .myInputs{
              width: 100%;
              display: none;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .login-show input[type="email"]{
              width: 100%;
              display: block;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .login-show input[type="file"]{
              width: 100%;
              display: block;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .login-show input[type="submit"] {
              max-width: 150px;
              width: 100%;
              background: blue;
              color: #f9f9f9;
              border: none;
              padding: 10px;
              text-transform: uppercase;
              border-radius: 2px;
              float:right;
              cursor:pointer;
          }
          .login-show a{
              display:inline-block;
              padding:10px 0;
          }

          .register-show input[type="text"], .register-show input[type="password"], .myInputs{
              width: 100%;
              display: block;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .register-show input[type="email"]{
              width: 100%;
              display: block;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .register-show input[type="file"]{
              width: 100%;
              display: block;
              margin:20px 0;
              padding: 15px;
              border: 1px solid #b5b5b5;
              outline: none;
          }
          .register-show input[type="submit"] {
              max-width: 150px;
              width: 100%;
              background: #444444;
              color: #f9f9f9;
              border: none;
              padding: 10px;
              text-transform: uppercase;
              border-radius: 2px;
              float:right;
              cursor:pointer;
          }
          .credit {
              position:absolute;
              bottom:10px;
              left:10px;
              color: #3B3B25;
              margin: 0;
              padding: 0;
              font-family: Arial,sans-serif;
              text-transform: uppercase;
              font-size: 12px;
              font-weight: bold;
              letter-spacing: 1px;
              z-index: 99;
          }
          a{
              text-decoration:none;
              color:#2c7715;
          }

          /*style checkbox*/

          .container {
              display: inline;
              position: relative;
              padding-left: 35px;
              margin-bottom: 12px;
              cursor: pointer;
              font-size: 22px;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
          }

          /* Hide the browser's default checkbox */
          .container input {
              position: absolute;
              opacity: 0;
              cursor: pointer;
              height: 0;
              width: 0;
          }

          /* Create a custom checkbox */
          .checkmark {
              position: absolute;
              top: 0;
              left: 0;
              height: 25px;
              width: 25px;
              background-color: #eee;
          }

          /* On mouse-over, add a grey background color */
          .container:hover input ~ .checkmark {
              background-color: #ccc;
          }

          /* When the checkbox is checked, add a blue background */
          .container input:checked ~ .checkmark {
              background-color: #2196F3;
          }

          /* Create the checkmark/indicator (hidden when not checked) */
          .checkmark:after {
              content: "";
              position: absolute;
              display: none;
          }

          /* Show the checkmark when checked */
          .container input:checked ~ .checkmark:after {
              display: block;
          }

          /* Style the checkmark/indicator */
          .container .checkmark:after {
              left: 9px;
              top: 5px;
              width: 5px;
              height: 10px;
              border: solid white;
              border-width: 0 3px 3px 0;
              -webkit-transform: rotate(45deg);
              -ms-transform: rotate(45deg);
              transform: rotate(45deg);
          }

      </style>
  </head>
  <body>
  <div class="login-reg-panel">
      <div class="login-info-box">
          <h2>Have an account?</h2>
          <p>Lorem ipsum dolor sit amet</p>
          <label id="label-register" for="log-reg-show">Login</label>
          <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
      </div>

      <div class="register-info-box">
          <h2>Don't have an account?</h2>
          <p>Lorem ipsum dolor sit amet</p>
          <label id="label-login" for="log-login-show">Register</label>
          <input type="radio" name="active-log-panel" id="log-login-show">
      </div>

      <div class="white-panel">
          <div class="login-show">
              <form method="post" action="<?= site_url("admin") . "/login/validate_credentials" ?>">
                  <h2>LOGIN</h2>
                  <input type="text" name="user_name" placeholder="Username">
                  <input type="password" name="password" placeholder="Password">
                  <?php
                  if(isset($message_error) && $message_error){
                      echo '<div class="alert alert-error">';
                      echo '<a class="close" data-dismiss="alert">×</a>';
                      echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
                      echo '</div>';
                  }?>
                  <input type="submit" value="Login">
                  <a href="">Forgot password?</a>
              </form>
          </div>
          <?php
          //form validation
            $errors = $this->form_validation->error_array();
            $username_error = $this->session->userdata('username');

          ?>
          <?php $roll = ['admin' => 'admin', 'users' => 'user'];  ?>
          <div class="register-show">
              <?php echo form_open_multipart('admin/create_member', 'class = "form_signin"')?>

                      <h2>REGISTER</h2>

                      <h6><?= (!empty($username_error) && isset($username_error))? 'Username already taken' : '' ?></h6>

                      <input type="text" data-name="inpVal"  value="<?php echo set_value('first_name'); ?>" name="first_name" placeholder="Your first name..">

                      <p style="color: red"><?= (!empty($errors) & isset($errors)) ? $errors['first_name'] : '';  ?></p>

                      <input type="text" data-name="inpVal" value="<?php echo set_value('last_name'); ?>" name="last_name" placeholder="Your last name..">

                      <p style="color: red"><?= (!empty($errors) & isset($errors)) ? $errors['last_name'] : ''; ?></p>

                      <input type="email" data-name="inpVal" value="<?php echo set_value('email_address'); ?>" id="emailTest" name="email_address" placeholder="Your Email..">

                      <p style="color: red"><?= (!empty($errors) & isset($errors)) ? $errors['email_address'] : ''; ?></p>

                      <input type="text" data-name="inpVal"  value="<?php echo set_value('username'); ?>" name="username" placeholder="Your username">

                      <p style="color: red"><?= (!empty($errors) & isset($errors)) ? $errors['username'] : ''; ?></p>

                      <input type="password"  value id="myPass" data-name="inpVal" name="password" placeholder="Your password">

                      <p style="color: red"><?= (!empty($errors) & isset($errors)) ? $errors['password'] : ''; ?></p>

                      <input type="password"  value id="myPass"  data-name="inpVal" name="password2" placeholder="Your password">

                      <p style="color: red"><?= (!empty($errors) & isset($errors)) ? $errors['password2'] : ''; ?></p>

                      <?php echo form_upload('file', 'save', 'class = "myInputs"')?>

                      <select class="myInputs" name="roll" id="">
                          <option value="<?= $roll['users']?>">User</option>
                          <option value="<?= $roll['admin']?>">Admin</option>
                      </select>

                      <label class="container">Show
                          <input type="checkbox">
                          <span class="checkmark"></span>
                      </label>
                     <input type="submit" value="Login">
              </form>
          </div>
      </div>
  </div>
  <!------ Include the above in your HEAD tag ---------->



  <script>

      $(document).ready(function(){
          $('.login-info-box').fadeOut();
          $('.login-show').addClass('show-log-panel');
      });


      $('.login-reg-panel input[type="radio"]').on('change', function() {
          if($('#log-login-show').is(':checked')) {
              $('.register-info-box').fadeOut();
              $('.login-info-box').fadeIn();

              $('.white-panel').addClass('right-log');
              $('.register-show').addClass('show-log-panel');
              $('.login-show').removeClass('show-log-panel');

          }
          else if($('#log-reg-show').is(':checked')) {
              $('.register-info-box').fadeIn();
              $('.login-info-box').fadeOut();

              $('.white-panel').removeClass('right-log');

              $('.login-show').addClass('show-log-panel');
              $('.register-show').removeClass('show-log-panel');
          }
      });


  </script>
  </body>
</html>

