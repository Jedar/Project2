$(document).ready(function () {
    let signArr = [false,false,false];
    let checkNum;

    //initial part
    setCheckNum();

    function getInfo(message) {
        return "<i class=\"fa fa-exclamation-circle fa-lg\"></i> "+message;
    }
    function setCheckNum() {
        checkNumber = Math.floor(Math.random()*9000+1000);
        $(".check-number").text(checkNumber);
    }
    $("#bt-login").click(function () {
        let userName = $("#user-name");
        let userPsw = $("#user-psw");
        let userCheck = $("#user-check");
        if (userName.val()===""){
            userName.next().html(getInfo("用户名不能为空"));
            userName.next().removeClass("hidden");
            signArr[0]=false;
        }
        else {
            userName.next().addClass("hidden");
            signArr[0]=true;
        }
        if (userPsw.val()===""){
            userPsw.next().html(getInfo("密码不能为空"));
            userPsw.next().removeClass("hidden");
            signArr[1]=false;
        }
        else {
            userPsw.next().addClass("hidden");
            signArr[1]=true;
        }
        if (!userCheck.val()){
            userCheck.siblings("div").html(getInfo("请输入验证码"));
            userCheck.siblings("div").removeClass("hidden");
            signArr[2]=false;
        }
        else if (parseInt(userCheck.val())!==checkNumber){
            userCheck.siblings("div").html(getInfo("验证码错误"));
            userCheck.siblings("div").removeClass("hidden");
            signArr[2]=false;
        }
        else {
            userCheck.siblings("div").addClass("hidden");
            signArr[2]=true;
        }
        if (signArr[0]&&signArr[1]&&signArr[2]){
            $("input").val("");
        }
    });
});