$(document).ready(function () {
    let registerArr = [false,false,false,false,false,false,false];
    let checkNum;
    let rgstName = $("#register-name");
    let rgstPsw = $("#register-psw");
    let rgstSure = $("#register-sure");
    let rgstEmail = $("#register-email");
    let rgstPhone = $("#register-phone");
    let rgstAddress = $("#register-address");
    let userCheck = $("#user-check");
    rgstName.on('change',checkName);
    rgstPsw.change(checkPsw);
    rgstSure.change(checkPswSure);
    rgstEmail.change(checkEmail);
    rgstPhone.change(checkPhone);
    rgstAddress.change(checkAddress);
    userCheck.change(check);

    //initial part
    setCheckNum();

    function getInfo(message) {
        return "<i class=\"fa fa-exclamation-circle fa-lg\"></i> "+message;
    }
    function setCheckNum() {
        checkNumber = Math.floor(Math.random()*9000+1000);
        $(".check-number").text(checkNumber);
    }
    $("#bt-register").on('click',function () {
        checkName();
        checkPsw();
        checkPswSure();
        checkEmail();
        checkPhone();
        checkAddress();
        check();
        if (registerArr[0]&&registerArr[1]&&registerArr[2]&&registerArr[3]&&registerArr[4]&&registerArr[5]&&registerArr[6]){
            $.post('registerverify.php',{
                'name':rgstName.val(),
                'psw':rgstPsw.val(),
                'email':rgstEmail.val(),
                'tel':rgstPhone.val(),
                'address':rgstAddress.val()
            },function (result) {
                // result = JSON.parse(result);
                if (!result.success){
                    switch (result.type){
                        case 'name':
                            registerArr[0]=false;
                            rgstName.next().html(getInfo("用户名已经存在"));
                            rgstName.val("");
                            rgstName.next().removeClass("hidden");
                            break;
                        case 'error':
                            alert(result.message);
                            break;
                    }
                }
                else {
                    window.location = 'home.php';
                }
            });
        }
    });
    function checkName() {
        registerArr[0]=false;
        if (rgstName.val()===""){
            rgstName.next().html(getInfo("昵称不能为空"));
            rgstName.next().removeClass("hidden");
        }
        else if(rgstName.val().length < 6){
            rgstName.next().html(getInfo("昵称长度不能小于6"));
            rgstName.next().removeClass("hidden");
        }
        else if(rgstName.val().match("^[0-9]*$")){
            rgstName.next().html(getInfo("昵称不能全为数字"));
            rgstName.next().removeClass("hidden");
        }
        else if(rgstName.val().match("^[a-zA-Z]*$")){
            rgstName.next().html(getInfo("昵称不能全为字母"));
            rgstName.next().removeClass("hidden");
        }
        else {
            rgstName.next().addClass("hidden");
            registerArr[0]=true;
        }
    };
    function checkPsw() {
        registerArr[1]=false;
        if (rgstPsw.val()===""){
            rgstPsw.next().html(getInfo("密码不能为空"));
            rgstPsw.next().removeClass("hidden");
        }
        else if(rgstPsw.val().length < 6){
            rgstPsw.next().html(getInfo("密码长度不能小于6"));
            rgstPsw.next().removeClass("hidden");
        }
        else if(rgstPsw.val()===rgstName.val()){
            rgstPsw.next().html(getInfo("密码与用户名重复"));
            rgstPsw.next().removeClass("hidden");
        }
        else {
            if (registerArr[2]&&(rgstSure.val()!==rgstPsw.val())){
                rgstSure.val("");
                registerArr[2] = false;
            }
            rgstPsw.next().addClass("hidden");
            registerArr[1]=true;
        }
    };
    function checkPswSure() {
        registerArr[2]=false;
        if (rgstSure.val()===""){
            rgstSure.next().html(getInfo("请确认密码"));
            rgstSure.next().removeClass("hidden");
        }
        else if (rgstSure.val()!==rgstPsw.val()){
            rgstSure.next().html(getInfo("确认密码错误"));
            rgstSure.next().removeClass("hidden");
        }
        else {
            rgstSure.next().addClass("hidden");
            registerArr[2]=true;
        }
    };
    function checkEmail() {
        registerArr[3]=false;
        if (rgstEmail.val()===""){
            rgstEmail.next().html(getInfo("邮箱为空"));
            rgstEmail.next().removeClass("hidden");
        }
        else if (!rgstEmail.val().match("^(\\w)+(\\.\\w+)*@(\\w)+((\\.\\w{2,3}){1,3})$")){
            rgstEmail.next().html(getInfo("邮箱格式错误"));
            rgstEmail.next().removeClass("hidden");
        }
        else {
            rgstEmail.next().addClass("hidden");
            registerArr[3]=true;
        }
    };
    function checkPhone() {
        registerArr[4]=false;
        if (rgstPhone.val()===""){
            rgstPhone.next().html(getInfo("电话为空")).removeClass("hidden");
        }
        else if (!rgstPhone.val().match("[0-9]{10}$")){
            rgstPhone.next().html(getInfo("电话格式错误")).removeClass("hidden");
        }
        else {
            rgstPhone.next().addClass("hidden");
            registerArr[4]=true;
        }
    };
    function checkAddress() {
        registerArr[5]=false;
        if (rgstAddress.val()===""){
            rgstAddress.next().html(getInfo("电话为空")).removeClass("hidden");
        }
        else {
            rgstAddress.next().addClass("hidden");
            registerArr[5]=true;
        }
    };
    function check() {
        if (!userCheck.val()){
            userCheck.siblings("div").html(getInfo("请输入验证码"));
            userCheck.siblings("div").removeClass("hidden");
            registerArr[6]=false;
        }
        else if (parseInt(userCheck.val())!==checkNumber){
            userCheck.siblings("div").html(getInfo("验证码错误"));
            userCheck.siblings("div").removeClass("hidden");
            registerArr[6]=false;
        }
        else {
            userCheck.siblings("div").addClass("hidden");
            registerArr[6]=true;
        }
    };
});