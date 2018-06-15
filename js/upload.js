$(document).ready(function () {
    let imageFlag = false;
    let formFlag = false;
    $("#imageFile").on('change',function checkImg() {
        let file = this.files[0];
        let img = $("#img-preview");
        imageFlag = true;
        if (!file){
            img.removeAttr('src');
            showError($(this),'Please choose an image file.');
            imageFlag = false;
            return;
        }
        if (!(/^image\/png$|jpeg$/.test(file.type))){
            showError($(this),'Please choose an image file with jpg or jpeg or png.');
            imageFlag = false;
            return;
        }
        hideError($(this));
        let oburl = window.URL.createObjectURL(file);
        img.attr("src", oburl) ;
    });
    $("#bt-upload").on('click',function () {
        formFlag = true;
        $('form input').each(function () {
            if (!($(this).is("#imageFile"))){
                if (!$(this).val()){
                    formFlag = false;
                    showError($(this),'Empty input!');
                }
                else {
                    hideError($(this));
                    if ($(this).is("#year")){
                        if (!(/^-?\\d+$/.test($(this).val()))){
                            formFlag = false;
                            showError($(this),'Wrong Year Input!');
                        }else {
                            hideError($(this));
                        }
                    }
                    if ($(this).is("#width")||$(this).is("#height")){
                        if (/^(([0-9]+\\\\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\\\\.[0-9]+)|([0-9]*[1-9][0-9]*))$/.test($(this).val())||/^[0-9]*[1-9][0-9]*$/.test($(this).val())){
                            hideError($(this));
                        }else {
                            formFlag = false;
                            showError($(this),'Wrong Length input!');
                        }
                    }
                    if ($(this).is("#price")){
                        if (/^[0-9]*[1-9][0-9]*$/.test($(this).val())){
                            hideError($(this));
                        }else {
                            formFlag = false;
                            showError($(this),'Wrong Price Input!');
                        }
                    }
                }
            }else {
                if (!imageFlag){
                    showError($(this),'Please choose an image file.');
                    imageFlag = false;
                }
            }
        });
        $("form textarea").each(function () {
            if (!$(this).val()){
                formFlag = false;
                showError($(this),'Empty Description input!');
            }
            else {
                hideError($(this));
            }
        });
        if (imageFlag&&formFlag){
            alert('right input');
        }
    });
    function showError(ele,message){
        ele.siblings('div').html('<i class="fa fa-exclamation-circle fa-lg"></i> '+message);
        ele.siblings('div').removeClass('hidden');
    }
    function hideError(ele) {
        ele.siblings('div').addClass('hidden');
    }
});