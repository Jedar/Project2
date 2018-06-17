$(document).ready(function () {
    let bt_logout = $('#bt-logout');
    let bt_confirm = $("#bt-confirm");
    let modal_footer = $(".modal-footer");
    let bt_recharge_commit = $("#bt-recharge-commit");
    let div_recharge = $("#recharge-input");

    function showTip(message) {
        $(".tip-content").html(message);
        $("#tip").removeClass('hidden').fadeIn("fast",function () {
            $("#tip").fadeOut(2000,function () {
                $("#tip").addClass('hidden');
            });
        });
    }
    function showError(message) {
        $(".error-content").html(message);
        $("#error").removeClass('hidden').fadeIn("fast",function () {
            $("#error").fadeOut(2000,function () {
                $("#error").addClass('hidden');
            });
        });
    }
    function confirm(message,type=0,header='Confirm') {
        let comfirm_modal = $("#confirm");
        bt_logout.detach();
        bt_confirm.detach();
        comfirm_modal.find(".modal-body h4").html(message);
        comfirm_modal.find(".modal-title").html(header);
        if (type === 0){
            modal_footer.prepend(bt_logout);
        }
        if (type === 1){
            modal_footer.prepend(bt_confirm);
        }
        comfirm_modal.modal();
    }

    //add event listener
    $("#signout").on('click',function () {
        confirm('确认退出？',0);
    });
    bt_logout.on('click',function () {
        $.post('logout.php',{

        },function (result) {
            result = JSON.parse(result);
            if (!result['success']){
                confirm(result.message,1);
            }
            else {
                showTip('退出成功');
                if (result['turnpage']){
                    window.location = 'home.php';
                }
                else {
                    window.location = window.location.pathname;
                }
            }
        })
    });
    $("#bt-search").on('click',function () {
        let info = $("#search-input").val();
        location.assign('search.php?info='+info);
    });
    $("#bt-addToCart").on('click',function () {
        if ($(this).is('.disabled')){
            return;
        }
        let artworkID = this.getAttribute('data-target');
        $.post('cart_handle.php',{
            'artworkID':artworkID,
            'optype':'insert'
        },function (result) {
            result = JSON.parse(result);
            if (result.success){
                let numDom = $("#top-shoppingcart-num");
                let number = parseInt(numDom.html())+1;
                numDom.html(number);
                showTip('加入购物车成功');
            }
            else if (parseInt(result.errorType) === 3){
                showError('商品已经在购物车中');
            }
        })
    });
    $(".bt-delete").on('click',function () {
        let artworkID = this.getAttribute('data-id');
        let that = $(this);
        $.post('cart_handle.php',{
            'artworkID':artworkID,
            'optype':'delete'
        },function (result) {
            result = JSON.parse(result);
            if (result.success){
                let numDom = $("#top-shoppingcart-num");
                let number = parseInt(numDom.html())-1;
                numDom.html(number);
                showTip('删除成功');
                $("#bt-pay").html('<i class="fa fa-back"></i>结款:$'+result.totalPrice);
                that.parents(".item-like").slideUp();
            }
            else if (parseInt(result.errorType) === 4){
                showError('商品不在购物车中');
            }
        })
    });
    $(".bt-price").on('click',function () {
        let artworkID = this.getAttribute('data-id');
        let that = $(this);
        $.post('cart_handle.php',{
            'artworkArr':{
                '0':artworkID
            },
            'optype':'pay'
        },function (result) {
            result = JSON.parse(result);
            if (result.success){
                showTip('支付成功');
                $("#bt-pay").html('<i class="fa fa-back"></i>结款:$'+result.totalPrice);
                that.parents(".item-like").slideUp();
            }
            else{
                switch (parseInt(result.errorType)){
                    case 7:
                        confirm('金额不足，支付失败',1);break;
                    case 6:
                        confirm('艺术品已被购买',1);break;
                    default:
                        confirm('交易过程出错',1);break;
                }
            }
        })
    });
    $("#bt-pay").on('click',function () {
        let artworkNum = 0;
        let btPrice = document.getElementsByClassName('item-like');
        for (let i = 0; i < btPrice.length; i++){
            if (btPrice[i].style.display !== 'none'){
                artworkNum++;
            }
        }
        if (artworkNum === 0){
            showError('空的购物车');
            return;
        }
        $.post('cart_handle.php',{
            'number':artworkNum,
            'optype':'payAll'
        },function (result) {
            result = JSON.parse(result);
            if (result.success){
                showTip('支付成功');
                $("#bt-pay").html('<i class="fa fa-back"></i>结款:$'+result.totalPrice);
                $(".item-like").slideUp();
            }
            else {
                switch (parseInt(result.errorType)){
                    case 7:
                        confirm('金额不足，支付失败',1);break;
                    case 6:
                        confirm('艺术品已被购买',1);break;
                    default:
                        confirm('交易过程出错',1);break;
                }
            }
        })
    });
    $(".bt-amend").on('click',function () {
        let item = $(this).parents("tr").attr('data-target');
        location.assign('upload.php?upload_item='+item);
    });
    $(".bt-delete-item").on('click',function () {
        let item = $(this).parents("tr").attr('data-target');
        let that = $(this);
        $.post('upload_handle.php',{
            'artworkID':item,
            'type':'delete'
        },function (result) {
            result = JSON.parse(result);
            if (result.success){
                that.parents("tr").slideUp();
                showTip('Delete successfully');
            }else {
                confirm(result.message,1);
            }
        });
    });
    bt_recharge_commit.on('click',function () {
        let input = $("#recharge-input");
        let ch = input.val();
        if (ch){
            ch = parseFloat(ch);
            if (ch%1 !== 0){
                showConflict('输入金额不合法');
            }else if (ch <= 0){
                showConflict('输入金额非正数');
            }else if (ch > 10000){
                showConflict('请适当控制充值金额');
            }else {
                ch = parseInt(ch);
                input.next().addClass("hidden");
                $.post('upload_handle.php',{
                    'type':'recharge',
                    'number':ch
                },function (result) {
                    result = JSON.parse(result);
                    if (result.success){
                        input.val("");
                        let before = $("#user-data-money");
                        let now = parseInt(before.html()) + ch;
                        before.html(now);
                        $("#modal-recharge").modal('hide');
                        showTip("充值成功");
                    }else {
                        showError(result.message);
                    }
                })
            }
        }
        function showConflict(message) {
            input.next().removeClass("hidden");
            input.next().html("<i class=\"fa fa-exclamation-circle fa-lg\"></i>"+message);
        }
    })
});