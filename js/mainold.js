$(document).ready(function () {
    var checkNumber;
    var user_name = "";
    var user_psw = "";
    var user_money = 0;
    var user_tel = "";
    var user_address = "";
    var user_email = "";
    var is_signed = false;
    var signArr = [false,false,false];
    var registerArr = [false,false,false,false,false,false];
    var trackArr = [];
    var trackType = [];
    var trackName = ["首页","搜索","商品详情","购物车","个人页面"];
    var trackNum = 0;
    var cartNum = 0;
    var cartItem = [];
    var cartPrice = [];
    const MAX_TRACKNUM = 5;
    var itemName = ["Adoration...","Alba Madonna","Reap leap","Still life with bowl and fruit","Family of..."];
    var itemAuthor = ["Poblo Picasso","Paul","Raphael"];

    //begin process
    freshVar();
    freshTopNav();
    freshDetailPage();
    freshCart();
    freshUserData();

    //fundamental function
    function signout() {
        user_name=undefined;
        user_psw=undefined;
        user_money=0;
        is_signed=false;
        sessionStorage.removeItem("user_name");
        sessionStorage.removeItem("user_money");
        writeInfo("is_signed","false");
    }
    function getInfo(message) {
        return "<i class=\"fa fa-exclamation-circle fa-lg\"></i> "+message;
    }
    function showTip(message) {
        $(".tip-content").html(message);
        $(".tip").css("display","block").fadeIn("fast",function () {
            $(".tip").fadeOut(2000,function () {
                $(".tip").css("display","none");
            });
        });
    }
    function writeInfo(name, value) {
        sessionStorage.setItem(name,value);
    }
    function freshVar(){
        cartNum = (sessionStorage.getItem("cartNum") === null)?0:parseInt(sessionStorage.getItem("cartNum"));
        var x1=sessionStorage.getItem("is_signed");
        is_signed=!(x1 === null || x1 === "false");
        if (is_signed){
            user_name=sessionStorage.getItem("user_name");
            user_money=sessionStorage.getItem("user_money");
        }
        var x2=sessionStorage.getItem("trackNum");
        trackNum=(x2 === null)?0:parseInt(x2);
        //fresh cart item
        for (i = 0; i < cartNum;i++){
            cartItem[i] = sessionStorage.getItem("cartItem"+i);
            cartPrice[i] = sessionStorage.getItem("cartPrice"+i);
        }

        // have not inputed
        for (var i = 0; i < trackNum;i++){
            trackType[i] = sessionStorage.getItem("trackType"+i);
            trackArr[i] = sessionStorage.getItem("trackAdd"+i);//tract addresss array mark
        }
        if (trackArr.length > MAX_TRACKNUM) {
            trackNum--;
        }
        trackArr[trackNum]=location.pathname;
        function getType() {
            var m = location.pathname;
            if (m.lastIndexOf("home.html") !== -1){
                return 0;
            }
            else if(m.lastIndexOf("search.html") !== -1){
                return 1;
            }else if(m.lastIndexOf("detail.html") !== -1){
                return 2;
            }
            else if(m.lastIndexOf("shoppingcart.html") !== -1){
                return 3;
            }
            else if(m.lastIndexOf("userpage.html") !== -1){
                return 4;
            }
            else {
                return 0;
            }
        }
        trackType[trackNum]=getType();
        writeInfo("trackType"+trackNum,trackType[trackNum]);
        writeInfo("trackAdd"+trackNum,location.pathname);

        //create track bar
        $(".track").empty();
        for (i = 0; i < trackArr.length ;i++){
            if (i === 0){
                $(".track").append('<li>您的足迹： </li>');
            }
            if (i === trackArr.length - 1){
                $(".track").append('<li>'+trackName[trackType[i]]+'</li>');
                break;
            }
            $(".track").append('<li><a href="'+trackArr[i]+'" id="track-item-'+i+'">'+trackName[trackType[i]]+'</a></li>\n' +
                '            <li> -> </li>');
        }
        writeInfo("trackNum",++trackNum);
    }
    function freshTopNav() {
        if (is_signed){
            var user_nameStr = (user_name.length > 6)?user_name.substr(0,5)+"...":user_name;
            $("#top-tip").css("display","none");
            $(".login-or-sign").css("display","none");
            $("#top-signin").html('<a href="userpage.html" class=""><i class="fa fa-user-circle"></i> '+user_nameStr+'</a>');
            $("#top-signout").css("display","inline-block");
            $("#top-shoppingcart-num").html(cartNum);
            $("#top-shoppingcart").css("display","inline-block");
            $(".sign").css("pointer-events","none");
            $(".register").css("pointer-events","none");
            $("#nav-release").css("display","inline-block");
        }
        else {
            $("#top-tip").css("display","inline-block");
            $(".login-or-sign").css("display","inline-block");
            $("#top-signin").html('<a href="#" class="sign"><i class="fa fa-user-circle">未登陆</i></a>');
            $("#top-signout").css("display","none");
            $("#top-shoppingcart").css("display","none");
            $(".sign").css("pointer-events","auto");
            $(".register").css("pointer-events","auto");
            $("#nav-release").css("display","none");
        }
    }
    function addItemToCart(pathName) {
        if (is_signed){
            var priceStr;
            var i;
            if (location.pathname.lastIndexOf("detail.html") === -1){
                price = Math.floor(Math.random()*100)*10;
                priceStr =price+".0000";
                $("#price").html(priceStr);
            }
            else {
                priceStr = $("#price").html();
            }
            writeInfo("cartItem"+cartNum,pathName);
            writeInfo("cartPrice"+cartNum,priceStr);
            writeInfo("cartNum",++cartNum);
            freshTopNav();
            showTip("添加至购物车成功");
        }
    }
    function freshItemPrice() {
        if (location.pathname.lastIndexOf("detail.html") !== -1){
            var price = Math.floor(Math.random()*100)*10;
            var priceStr =price+".0000";
            $("#price").html(priceStr);
        }
    }
    function freshCart() {
        if (location.pathname.lastIndexOf("shoppingcart.html") !== -1){
            $(".item-wrapper").empty();
            var i;
            for (i = 0; i < cartNum; i++){
                $(".item-wrapper").append('<div class="item-like" id="item-like-'+i+'">\n' +
                    '            <figure>\n' +
                    '                <a href="detail.html"><img src="images/works/square-medium/'+cartItem[i]+'"></a>\n' +
                    '            </figure>\n' +
                    '            <div class="item-name">\n' +
                    '               <h3>'+itemName[i%itemName.length]+'</h3>\n' +
                    '               <p>'+itemAuthor[i%itemAuthor.length]+'</p>\n' +
                    '            </div>\n' +
                    '            <div>\n' +
                    '                <button class="bt-price" id="bt-price-'+i+'"><i class="fa fa-star"></i> 价格:$<span class="item-price">'+cartPrice[i]+'</span></button>\n' +
                    '                <button class="bt-delete" id="bt-delete-'+i+'"><i class="fa fa-sign-out"></i> 删除</button>\n' +
                    '            </div>\n' +
                    '        </div>');
            }
            $(".item-wrapper").append('<div class="pay-div">\n' +
                '            <button id="bt-pay"><i class="fa fa-back"></i>结款:$000</button>\n' +
                '        </div>');
            freshPayment();
        }
    }
    function freshPayment() {
        if (location.pathname.lastIndexOf("shoppingcart.html") !== -1){
            var totalPrice = 0;
            var i;
            for (i = 0; i < cartNum; i++){
                totalPrice+=parseInt(cartPrice[i]);
            }
            $("#bt-pay").html('<i class="fa fa-back"></i>结款:$'+totalPrice);
        }
    }
    function freshUserData() {
        if (location.pathname.lastIndexOf("userpage.html") !== -1) {
            $("#user-data-name").html(user_name);
            $("#user-data-money").html(user_money);
            user_tel = (sessionStorage.getItem("user_tel") === null)?"":sessionStorage.getItem("user_tel");
            user_email = (sessionStorage.getItem("user_email") === null)?"":sessionStorage.getItem("user_email");
            user_address = (sessionStorage.getItem("user_address") === null)?"":sessionStorage.getItem("user_address");
            $("#user-data-phone").html(user_tel);
            $("#user-data-address").html(user_address);
            $("#user-data-email").html(user_email);
        }
    }
    function freshDetailPage() {
        if (location.pathname.lastIndexOf("detail.html") !== -1) {
            var num = Math.floor(Math.random()*10);
            function getQueryString(name) {
                var result = window.location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
                if (result == null || result.length < 1) {
                    return "";
                }
                return result[1];
            }
            var pathStr = getQueryString("path");
            if (pathStr !== ""){
                $(".goods-name").html(itemName[num%itemName.length]);
                $(".goods-author").html("By "+itemAuthor[num%itemAuthor.length]);
                $(".small img").attr("src","images/works/average/"+pathStr);
                $(".big img").attr("src","images/works/large/"+pathStr);
                freshItemPrice();
            }
            else {
                $(".goods-name").html("Mother and Child(Olga and Son)");
                $(".goods-author").html("By Poblo Picasso");
                $(".small img").attr("src","images/works/average/094070.jpg");
                $(".big img").attr("src","images/works/large/094070.jpg");
            }
            //magnify script
            var box = document.getElementById("box");
            var smallBox = document.getElementById("smallBox");
            var bigBox = document.getElementById("bigBox");
            var bigImg = document.getElementById("bigImg");
            var mask = document.getElementById("mask");//1.鼠标经过小盒子 显示遮罩和大盒子 鼠标离开后隐藏
            smallBox.onmouseover = function() {
                mask.style.display = "block";
                bigBox.style.display = "block";
            };
            smallBox.onmouseout = function() {
                mask.style.display = "none";
                bigBox.style.display = "none";
            };
            smallBox.onmousemove = function(event) {
                var event = event || window.event;var pageX = event.pageX || event.clientX + document.documentElement.scrollLeft;
                var pageY = event.pageY || event.clientY + document.documentElement.scrollTop;
                var targetX = pageX - box.offsetLeft;
                var targetY = pageY - box.offsetTop;
                var maskX = targetX - mask.offsetWidth / 2;
                var maskY = targetY - mask.offsetHeight / 2;
                if (maskX < 0) {
                    maskX = 0;
                }
                if (maskX > smallBox.offsetWidth - mask.offsetWidth) {
                    maskX = smallBox.offsetWidth - mask.offsetWidth;
                }
                if (maskY < 0) {
                    maskY = 0;
                }if (maskY > smallBox.offsetHeight - mask.offsetHeight) {
                    maskY = smallBox.offsetHeight - mask.offsetHeight;
                }
                mask.style.left = maskX + "px";
                mask.style.top = maskY + "px";
                var bigToMove = bigImg.offsetWidth - bigBox.offsetWidth;
                var maskToMove = smallBox.offsetWidth - mask.offsetWidth;
                var rate = bigToMove / maskToMove;
                bigImg.style.left = -rate * maskX + "px";
                bigImg.style.top = -rate * maskY + "px";};
        }
    }
    function deleteItem(index){
        var i;
        for (i = index; i < cartNum-1; i++){
            writeInfo("cartItem"+i,cartItem[i+1]);
            writeInfo("cartPrice"+i,cartPrice[i+1]);
        }
        writeInfo("cartNum",--cartNum);
    }

    //function band with button
    $(".track-div a").click(function () {
        var i;
        var index = $(this).attr("id");
        var indexStr = index.match(/\d/);
        for (i = parseInt(indexStr); i < trackNum; i++){
            sessionStorage.removeItem("trackType"+i);
            sessionStorage.removeItem("teackAdd"+i);
        }
        writeInfo("trackNum",indexStr);
    });
    $(".bt-search").click(function () {
        location.href = "search.html";
    });
    $("#bt-recharge").click(function () {
        $("#rechargeModal").css("display","block");
    });
    $(".bt-price").click(function () {
        var flag = confirm("确认支付？");
        if (flag){
            $(this).parents(".item-like").slideUp();
            var indexStr = $(this).attr("id");
            var index = indexStr.match(/\d/);
            deleteItem(index);
            showTip("支付成功");
            freshPayment();
            freshTopNav();
        }
    });
    $("#bt-pay").click(function () {
        var flag = confirm("确认支付？");
        if (flag){
            var i,temp;
            $(".item-like").slideUp();
            temp = cartNum;
            for (i = 0; i < temp; i++){
                deleteItem(i);
            }
            showTip("支付成功");
            freshTopNav();
            freshPayment();
        }
    });
    $(".bt-learnMore").click(function () {
        location.href="detail.html";
    });
    $(".bt-delete").click(function () {
        $(this).parents(".item-like").slideUp();
        var indexStr = $(this).attr("id");
        var index = indexStr.match(/\d/);
        deleteItem(index);
        showTip("删除成功");
        freshPayment();
        freshTopNav();
    });
    $(".bt-addToCart").click(function () {
        var pathname = $(".detail-fig img").attr("src").match(/\d{6}\.jpg/g);
        addItemToCart(pathname);
    });
    $(".sign").click(function () {
        checkNumber = Math.floor(Math.random()*9000+1000);
        $(".check-number").text(checkNumber);
        $("#signModal").css("display","block");
    });
    $(".register").click(function () {
        $("#registerModal").css("display","block");
    });
    $("#top-signout a").click(function () {
        signout();
        freshTopNav();
        showTip("退出成功");
    });
    $("#signModal-close").click(function () {
        $("input").val("");
        $(".conflictDiv").css("display","none");
        signout();
        $("#signModal").css("display","none");
    });
    $("#registerModal-close").click(function () {
        $("input").val("");
        $(".conflictDiv").css("display","none");
        signout();
        $("#registerModal").css("display","none");
    });
    $("#rechargeModal-close").click(function () {
        $("input").val("");
        $(".conflictDiv").css("display","none");
        $("#rechargeModal").css("display","none");
    });
    $("#signModal-submit").click(function () {
        if (signArr[0]&&signArr[1]&&signArr[2]){
            $("input").val("");
            $(".conflictDiv").css("display","none");
            $("#signModal").css("display","none");
            is_signed=true;
            writeInfo("is_signed","true");
            writeInfo("user_name",user_name);
            writeInfo("user_money",user_money);
            showTip("登陆成功");
            freshTopNav();
        }
    });
    $("#registerModal-submit").click(function () {
        if (registerArr[0]&&registerArr[1]&&registerArr[2]&&registerArr[3]&&registerArr[4]&&registerArr[5]){
            $("input").val("");
            $(".conflictDiv").css("display","none");
            $("#registerModal").css("display","none");
            is_signed=true;
            writeInfo("is_signed","true");
            writeInfo("user_name",user_name);
            writeInfo("user_money",user_money);
            writeInfo("user_email",user_email);
            writeInfo("user_address",user_address);
            writeInfo("user_tel",user_tel);
            showTip("注册成功");
            freshTopNav();
        }
    });
    $("#rechargeModal-submit").click(function () {
        var num = parseInt($("#recharge-num").val());
        if ($("#recharge-num").val() === ""){
            $("#recharge-num").next().html(getInfo("请输入充值金额")).css("display","block");
        }else if (num <= 0){
            $("#recharge-num").next().html(getInfo("充值金额不合法")).css("display","block");
        }else {
            $("input").val("");
            $("#rechargeModal").css("display","none");
            user_money =parseInt(user_money)+num;
            writeInfo("user_money",user_money);
            showTip("充值成功");
            freshUserData();
        }
    });
    $("#user-name").change(function () {
        signArr[0]=false;
        if ($("#user-name").val()===""){
            $("#user-name").next().html(getInfo("用户名不能为空")).css("display","block");
        }else if(false){
            $("#user-name").next().html(getInfo("用户名不存在")).css("display","block");
        }
        else {
            $("#user-name").next().css("display","none");
            user_name=$("#user-name").val();
            signArr[0]=true;
        }
    });
    $("#user-psw").change(function () {
        signArr[1]=false;
        if ($("#user-psw").val()===""){
            $("#user-psw").next().html(getInfo("密码不能为空")).css("display","block");
        }
        else if(false){//$("#user-psw").val()!=="123456"
            $("#user-psw").next().html(getInfo("密码错误")).css("display","block");
        }
        else {
            $("#user-psw").next().css("display","none");
            signArr[1]=true;
        }
    });
    $("#user-check").change(function () {
        signArr[2]=false;
        if ($("#user-check").val()!=checkNumber){
            $("#user-check").siblings("div").html(getInfo("验证码错误")).css("display","block");
        }
        else {
            $("#user-check").siblings("div").css("display","none");
            signArr[2]=true;
        }
    });
    $("#register-name").change(function () {
        registerArr[0]=false;
        if ($("#register-name").val()===""){
            $("#register-name").next().html(getInfo("昵称不能为空")).css("display","block");
        }
        else if($("#register-name").val().length < 6){
            $("#register-name").next().html(getInfo("昵称长度不能小于6")).css("display","block");
        }
        else if($("#register-name").val().match("^[a-zA-Z]*$")||$("#register-name").val().match("^[0-9]*$")){
            $("#register-name").next().html(getInfo("昵称不能全为数字或字母")).css("display","block");
        }
        else {
            user_name=$("#register-name").val();
            $("#register-name").next().css("display","none");
            registerArr[0]=true;
        }
    });
    $("#register-psw").change(function () {
        registerArr[1]=false;
        if ($("#register-psw").val()===""){
            $("#register-psw").next().html(getInfo("密码不能为空")).css("display","block");
        }
        else if($("#register-psw").val().length < 6){
            $("#register-psw").next().html(getInfo("密码长度不能小于6")).css("display","block");
        }
        else if($("#register-psw").val()===user_name){
            $("#register-psw").next().html(getInfo("密码与用户名重复")).css("display","block");
        }
        else {
            user_psw = $("#register-psw").val();
            $("#register-sure").val("");
            $("#register-psw").next().css("display","none");
            registerArr[1]=true;
        }
    });
    $("#register-sure").change(function () {
        registerArr[2]=false;
        if ($("#register-sure").val()===""){
            $("#register-sure").next().html(getInfo("请确认密码")).css("display","block");
        }
        else if ($("#register-sure").val()!==user_psw){
            $("#register-sure").next().html(getInfo("确认密码错误")).css("display","block");
        }
        else {
            $("#register-sure").next().css("display","none");
            registerArr[2]=true;
        }
    });
    $("#register-email").change(function () {
        registerArr[3]=false;
        if ($("#register-email").val()===""){
            $("#register-email").next().html(getInfo("邮箱为空")).css("display","block");
        }
        else if (!$("#register-email").val().match("^(\\w)+(\\.\\w+)*@(\\w)+((\\.\\w{2,3}){1,3})$")){
            $("#register-email").next().html(getInfo("邮箱格式错误")).css("display","block");
        }
        else {
            $("#register-email").next().css("display","none");
            user_email = $("#register-email").val();
            registerArr[3]=true;
        }
    });
    $("#register-phone").change(function () {
        registerArr[4]=false;
        if ($("#register-phone").val()===""){
            $("#register-phone").next().html(getInfo("电话为空")).css("display","block");
        }
        else if (!$("#register-phone").val().match("[0-9]{10}$")){
            $("#register-phone").next().html(getInfo("电话格式错误")).css("display","block");
        }
        else {
            $("#register-phone").next().css("display","none");
            user_tel = $("#register-phone").val();
            registerArr[4]=true;
        }
    });
    $("#register-address").change(function () {
        registerArr[5]=false;
        if ($("#register-address").val()===""){
            $("#register-address").next().html(getInfo("电话为空")).css("display","block");
        }
        else {
            $("#register-address").next().css("display","none");
            user_address = $("#register-address").val();
            registerArr[5]=true;
        }
    });
});