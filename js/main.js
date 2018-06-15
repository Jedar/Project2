$(document).ready(function () {
    function showTip(message) {
        $(".tip-content").html(message);
        $("#tip").removeClass('hidden').fadeIn("fast",function () {
            $("#tip").fadeOut(2000,function () {
                $("#tip").addClass('hidden');
            });
        });
    }
    //add event listener
    $('#bt-logout').on('click',function () {
        $.post('logout.php',{

        },function (result) {
            result = JSON.parse(result);
            if (!result['success']){
                alert(result['message']);
            }
            else {
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
        if (this.hasClass('disabled')){
            return;
        }
        let artworkID = this.getAttribute('data-target');
        $.post('cart_handle.php',{
            'artworkID':artworkID,
            'optype':'insert'
        },function (result) {
            result = JSON.parse(result);
            if (result.success){
                showTip('加入购物车成功');
            }
            else if (parseInt(result.errorType) === 3){
                showTip('商品已经在购物车中');
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
                showTip('删除成功');
                $("#bt-pay").html('<i class="fa fa-back"></i>结款:$'+result.totalPrice);
                that.parents(".item-like").slideUp();
            }
            else if (parseInt(result.errorType) === 4){
                showTip('商品不在购物车中');
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
                        showTip('金额不足，支付失败');break;
                    case 6:
                        showTip('艺术品已被购买');break;
                    default:
                        alert('交易过程出错');
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
                alert(result.message);
            }
        })
    })
});