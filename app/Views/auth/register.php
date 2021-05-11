<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top:50px;">
            <div class="col-md-4 col-md-offset-4">
                <h4>Register Users</h4>
                <hr>
                <form action="<?= base_url('auth/save'); ?>" method="post" autocomplete="off">
                <?= csrf_field(); ?>
                <?php if(!empty(session()->getFlashdata('fail'))): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php endif ?>
                
                <?php
                //validar si se guarda bien o mal
                if(!empty(session()->getFlashdata('success'))): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">name</label>
                        <input type="name" class="form-control" id="name" name="name" value="<?=  set_value('name'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'name') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?=  set_value('email'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'email') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?=  set_value('cpassword'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : '' ?></span>

                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" value="<?=  set_value('cpassword'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'cpassword') : '' ?></span>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sing In</button><br>
                    <a href="<?= site_url('auth'); ?>">I already have account, login now</a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>