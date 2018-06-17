<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/basic.css">
    <link href="font/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" rel="script" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" rel="script" src="js/popper.min.js"></script>
    <script type="text/javascript" rel="script" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" rel="script" src="js/main.js"></script>
    <?php
    if (!isset($pagetype)){
        $pagetype = 0;
    }
    switch ($pagetype){
        case -2://register
            echo '<script type="text/javascript" rel="script" src="js/register.js"></script>';
            break;
        case -1://login
            echo '<script type="text/javascript" rel="script" src="js/login.js"></script>';
            break;
        case 0://home
            break;
        case 1://detail
            echo '<link rel="stylesheet" href="css/detail.css">';
            echo '<script type="text/javascript" rel="script" src="js/magnify.js"></script>';
            break;
        case 2://search
            echo '<script type="text/javascript" rel="script" src="js/search_pagination.js"></script>';
            echo '<link rel="stylesheet" href="css/search.css">';
            break;
        case 3://shopping cart
            echo '<link rel="stylesheet" href="css/shoppingcart.css">';
            break;
        case 4://userpage
            echo '<link rel="stylesheet" href="css/userpage.css">';
            break;
        case 5://release
            echo '<script type="text/javascript" rel="script" src="js/upload.js"></script>';
            break;
        case 6://mail
            break;
    }
    ?>
</head>