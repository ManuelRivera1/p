<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>
    <title><?= $title; ?></title>
</head>
<body>
<?php //echo "<pre>"; print_r($userInfo);die;echo "</pre>"; ?>
<div class="container">
  <h2><?= $title; ?></h2>
  <p>Usuario</p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>name</th>
        <th>email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $userInfo['name']; ?></td>
        <td><?= $userInfo['email']; ?></td>
        <td><a href="<?= site_url('auth/logout'); ?>">Logout</a></td>
      </tr>
      
    </tbody>
  </table>
</div>
</body>
</html>