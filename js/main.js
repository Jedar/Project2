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
        let artworkID = this.getAttribute('data-target');
        $.post('addToCart.php',{
            'artworkID':artworkID
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
});