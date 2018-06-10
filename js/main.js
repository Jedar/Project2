$(document).ready(function () {
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
    })
});