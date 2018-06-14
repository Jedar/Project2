<?php
session_start();
if (!isset($pagetype)){
    $pagetype = 0;
}
$_SESSION['pagetype']=$pagetype;
if (!isset($_SESSION['isSigned'])){
    $_SESSION['isSigned'] = false;
}
if ($pagetype != 0){
    if ($_SESSION['isSigned']){
        $userName = (strlen($_SESSION['name'])<6?$_SESSION['name']:substr($_SESSION['name'],0,5).'...');
        echo '<nav class="row bg-dark text-white top-nav justify-content-center">
    <div class="col-md-4">
        <span id="top-tip"><span id="top-logo">Art Store </span></span>
    </div>
    <ul class="col-md-3 offset-md-3 nav nav-justified">
        <li id="top-signin" class="nav-item"><a href="userpage.php" class="nav-link"><i class="fa fa-user-circle"></i>'.$userName.'</a></li>
        <li id="top-shoppingcart" class="nav-item"><a href="shoppingcart.php" class="nav-link"><i class="fa fa-shopping-cart"></i> 购物车 <span id="top-shoppingcart-num"></span></a> </li>
        <li id="top-signout" class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#confirm"><i class="fa fa-sign-out"></i> 登出</a> </li>
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
        <li id="top-signin" class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-user-circle"></i>未登录</a></li>
        <li id="top-shoppingcart" class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-shopping-cart"></i> 购物车 <span id="top-shoppingcart-num"></span></a> </li>
        <li id="top-signout" class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-sign-in"></i> 登陆</a> </li>
    </ul>
</nav>';
    }
}
if ($pagetype > 0){
    echo '<header class="normal-header">
    <div class="header-top row justify-content-center">
        <h2 class="logo col-md-3">Art Store</h2>
        <div class="searchBar col-md-3 offset-md-4 row">
            <input type="search" placeholder="搜索" class="form-control col-9 form-control-sm" id="search-input">
            <button type="button" class="btn btn-primary btn-sm col-2" id="bt-search"><i class="fa fa-search"></i> </button>
        </div>
    </div>
    <nav class="row bg-light" id="header-nav">
        <ul class="nav nav-tabs nav-justified col-md-5 offset-md-1">
            <li class="nav-item"><a href="home.php" class="nav-link">首页</a></li>
            <li class="nav-item"><a href="search.php" class="nav-link '.(($pagetype == 2)?'active':'').'">搜索</a></li>
            <li class="nav-item"><a href="detail.php" class="nav-link '.(($pagetype == 1)?'active':'').'">详情</a></li>
            <li class="nav-item"><a href="#" class="nav-link disabled '.(($pagetype == 5)?'active':'').'">发布艺术品</a> </li>
        </ul>
    </nav>
    <div id="track-div">
        <ul class="track nav">
            <li class="arrow">您的足迹： </li>
            <li><a href="home.php" class="nav-link">首页</a></li>
            <li class="arrow"><i class="fa fa-arrow-right"></i></li>
            <li><a href="search.php" class="nav-link">搜索</a></li>
            <li class="arrow"><i class="fa fa-arrow-right"></i></li>
            <li><a href="home.php" class="nav-link">首页</a></li>
        </ul>
    </div>
</header>';
}
?>