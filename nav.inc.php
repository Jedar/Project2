<?php
session_start();
include_once 'carts_fns.php';
if (!isset($pagetype)){
    $pagetype = 0;
}
$_SESSION['pagetype']=$pagetype;
if (!isset($_SESSION['isSigned'])){
    $_SESSION['isSigned'] = false;
}
include_once 'track.inc.php';
if (!$_SESSION['isSigned']&&($pagetype >= 3)){
    echo '<script type="text/javascript" rel="script">
    location.assign(\'login.php\');
    </script>';
    exit();
}
if ($pagetype != 0){
    if ($_SESSION['isSigned']){
        $userName = (strlen($_SESSION['name'])<25?$_SESSION['name']:substr($_SESSION['name'],0,24).'...');
        echo '<nav class="row bg-dark text-white top-nav justify-content-center">
    <div class="col-md-4">
        <span id="top-tip"><span id="top-logo">Art Store </span></span>
    </div>
    <ul class="col-md-4 offset-md-2 nav nav-justified">
        <li class="nav-item"><a href="userpage.php" class="nav-link" id="top-signin" data-sign="1"><i class="fa fa-user-circle"></i> '.$userName.'</a></li>
        <li class="nav-item"><a href="message.php" class="nav-link"><i class="fa fa-envelope-o">信息</i></a> </li>
        <li class="nav-item"><a href="shoppingcart.php" class="nav-link"><i class="fa fa-shopping-cart"></i> 购物车 <span class="badge badge-pill badge-danger" id="top-shoppingcart-num">'.getCartNum($_SESSION["userID"]).'</span></a> </li>
        <li class="nav-item"><a href="#" class="nav-link" id="signout" ><i class="fa fa-sign-out"></i> 登出</a> </li>
    </ul>
</nav>';
    }
    else{
        echo '<nav class="row bg-dark text-white top-nav justify-content-center">
    <div class="col-md-4">
        <span id="top-tip">欢迎来到<span id="top-logo">Art Store </span></span>
        <span class="login-or-sign"><a class="sign" href="login.php">登陆</a> 或 <a href="register.php" class="register">注册</a> </span>
    </div>
    <ul class="col-md-4 offset-md-2 nav nav-justified">
        <li class="nav-item"><a href="login.php" class="nav-link"  id="top-signin" data-sign="0"><i class="fa fa-user-circle"></i>未登录</a></li>
        <li class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-envelope-o"></i>信息</a> </li>
        <li class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-shopping-cart"></i> 购物车 </a> </li>
        <li class="nav-item"><a href="login.php" class="nav-link"><i class="fa fa-sign-in"></i> 登陆</a> </li>
    </ul>
</nav>';
    }
}
if ($pagetype > 0){
    echo '<header class="normal-header">
    <div class="header-top row justify-content-center">
        <h2 class="logo col-md-3">Art Store</h2>
        <div class="searchBar col-md-3 offset-md-4">
        <div class="form-inline" id="search-div">
        <input type="search" placeholder="enter title" class="form-control form-control-sm" id="search-title">
        <input type="search" placeholder="enter artist" class="form-control form-control-sm hidden" id="search-artist">
            <input type="search" placeholder="enter description" class="form-control form-control-sm hidden" id="search-description">
            <button type="button" class="btn btn-primary btn-sm" id="bt-search"><i class="fa fa-search"></i> </button>
        </div>
        <div>
        <label class="checkbox-inline"><input name="type" type="checkbox" id="typetitle" value="typetitle" checked> title</label>
        <label class="checkbox-inline"><input name="type" type="checkbox" id="typeartist" value="typeartist"> artist</label>
        <label class="checkbox-inline"><input name="type" type="checkbox" id="typedescription" value="typedescription"> description</label>
        </div>
        </div>
    </div>
    <nav class="row bg-light" id="header-nav">
        <ul class="nav nav-tabs nav-justified col-md-5 offset-md-1">
            <li class="nav-item"><a href="home.php" class="nav-link">首页</a></li>
            <li class="nav-item"><a href="search.php" class="nav-link '.(($pagetype == 2)?'active':'').'">搜索</a></li>
            <li class="nav-item"><a href="detail.php" class="nav-link '.(($pagetype == 1)?'active':'').'">详情</a></li>
            <li class="nav-item"><a href="upload.php" class="nav-link disabled '.(($pagetype == 5)?'active':'').'">发布艺术品</a> </li>
        </ul>
    </nav>';
    getTrack();
    echo '</header>';

}
?>
