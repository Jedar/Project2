<?php
session_start();
if (!isset($pagetype)){
    $pagetype = 0;
}
if ($pagetype != 0){
    if (!isset($_SESSION['isSigned'])){
        $_SESSION['isSigned'] = false;
    }
    if ($_SESSION['isSigned']){
        $userName = (strlen($_SESSION['name'])<6?$_SESSION['name']:substr($_SESSION['name'],0,5).'...');
        echo '<nav class="row bg-dark text-white top-nav justify-content-center">
    <div class="col-md-4">
        <span id="top-tip"><span id="top-logo">Art Store </span></span>
    </div>
    <ul class="col-md-3 offset-md-3 nav nav-justified">
        <li id="top-signin" class="nav-item"><a href="#" class="nav-link"><i class="fa fa-user-circle"></i>'.$userName.'</a></li>
        <li id="top-shoppingcart" class="nav-item"><a href="shoppingcart.php" class="nav-link"><i class="fa fa-shopping-cart"></i> 购物车 <span id="top-shoppingcart-num"></span></a> </li>
        <li id="top-signout" class="nav-item"><a href="#" class="nav-link"><i class="fa fa-sign-out"></i> 登出</a> </li>
    </ul>
</nav>';
    }
    else{
        echo '<nav class="row bg-dark text-white top-nav justify-content-center">
    <div class="col-md-4">
        <span id="top-tip">欢迎来到<span id="top-logo">Art Store </span></span>
        <span class="login-or-sign"><a class="sign" href="login.php">登陆</a> 或 <a href="register.php" class="register">注册</a> </span>
    </div>
    <ul class="col-md-3 offset-md-3 nav nav-justified">
        <li id="top-signin" class="nav-item"><a href="sign.php" class="nav-link"><i class="fa fa-user-circle"></i>未登录</a></li>
        <li id="top-shoppingcart" class="nav-item"><a href="sign.php" class="nav-link"><i class="fa fa-shopping-cart"></i> 购物车 <span id="top-shoppingcart-num"></span></a> </li>
        <li id="top-signout" class="nav-item"><a href="sign.php" class="nav-link"><i class="fa fa-sign-in"></i> 登陆</a> </li>
    </ul>
</nav>';
    }
}
?>