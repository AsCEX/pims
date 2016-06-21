<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="<?php echo site_url("assets/auth/normalize.css"); ?>" />
  <link rel="stylesheet" href="<?php echo site_url("assets/auth/style.css"); ?>" />
</head>

<body>
    <div class="login">
      <h2>Log In</h2>

      <div id="infoMessage"><?php echo $message;?></div>

        <?php echo form_open("auth/login");?>
      <fieldset>
          <?php echo form_input($identity);?>
          <?php echo form_input($password);?>
          <?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      </fieldset>
      <input type="submit" value="Log In" />
        <?php echo form_close();?>
      <div class="utilities">
        <a href="forgot_password">Forgot Password?</a>
        <!--<a href="#">Sign Up &rarr;</a>-->
      </div>
    </div>
</body>
</html>


<?php /*

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p> */ ?>