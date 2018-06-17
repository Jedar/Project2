<!DOCTYPE html>
<html lang="en">
<?php $pagetype = -1;?>
<?php include_once 'head.inc.php'; ?>
<body>
<?php include_once 'nav.inc.php'; ?>
<main class="login-img row">
    <div class="col-md-4 offset-md-6 card ">
        <div class="card-header">登陆</div>
        <form class="card-body" id="form-login">
            <div class="form-group">
                <label for="user-name">用户名：</label>
                <input class="form-control" type="text" name="user-name" id="user-name" placeholder="请输入用户名">
                <div class="conflictDiv hidden"></div>
            </div>
            <div class="form-group">
                <label for="user-psw">密码：</label>
                <input class="form-control" type="password" id="user-psw" name="user-psw">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label for="user-check">验证码：</label>
                <input class="form-control" type="text" id="user-check" name="user-check">
                <label class="check-number"></label>
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
        </form>
        <div class="card-footer">
            <button type="button" class="btn btn-primary float-right" id="bt-login">登陆</button>
        </div>
    </div>
</main>
<?php include 'foot.inc.php';?>
</body>
</html>