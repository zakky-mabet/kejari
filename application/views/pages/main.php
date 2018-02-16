<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo base_url('public/images/favicon.png') ?>" type="icon" />
  <link rel="stylesheet" href="<?php echo base_url('public/components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/components/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/components/Ionicons/css/ionicons.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/dist/css/style-login.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/plugins/iCheck/square/blue.css') ?>">
  <link rel="icon" href="<?php echo base_url('public/images/favicon.ico') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo text-center">
    <img src="<?php echo base_url('public/images/mainlogo.png') ?>" class="img-responsive" alt="Logo">
  </div>
  <div class="login-box-body">

      <div class="form-group">

      </div>
      <div class="form-group has-feedback">
        <label>NIP :</label>
        <input type="text" class="form-control" name="identity" placeholder="NIP">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Password :</label>
        <input type="password" class="form-control" name="password"  placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="checkbox icheck">

          </div>
        </div>
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </div>
      </div>
  </div>
</div>
<footer>
    <p class="text-center"><small>&copy; Hak Cipta <?php echo (date('Y')!=2018) ? date('2018 - Y') : date("Y");  ?> - KEJAKSAAN NEGERI <br> Kab. Bangka Barat, Kep. Bangka Belitung <br> Dikembangkan oleh <a href="http://www.teitramega.co.id" target="_blank" title="Go to Web CV. Teitra Mega">CV. Teitra Mega</a>, Pangkalpinang.</small></p>
</footer>
<script src="<?php echo base_url('public/components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('public/components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('public/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
    });
  });
</script>
</body>
</html>
