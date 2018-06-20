$(document).ready(function () {
    let imageFlag = false;
    let formFlag = false;
    let bt_upload = $("#bt-upload");
    let type = bt_upload.attr('data-type');
    let isUpdate = (type === 'update');
    let isFile = 0;

    $("form textarea").on('change',function () {
        if (!$(this).val()){
            formFlag = false;
            showError($(this),'Empty Description input!');
        }
        else {
            hideError($(this));
        }
    });
    $('form input').on('change',function () {
        if (!($(this).is("#imageFile"))){
            if (!$(this).val()){
                formFlag = false;
                showError($(this),'Empty input!');
            }
            else {
                hideError($(this));
                if ($(this).is("#year")){1
                    if (!(/^-?\d+$/.test($(this).val()))){
                        formFlag = false;
                        showError($(this),'Wrong Year Input!');
                    }else {
                        hideError($(this));
                    }
                }
                if ($(this).is("#width")||$(this).is("#height")){
                    if (/^[0-9]+(.[0-9]{1,5})$/.test($(this).val())||/^[1-9][0-9]*$/.test($(this).val())){
                        hideError($(this));
                    }else {
                        formFlag = false;
                        showError($(this),'Wrong Length input!');
                    }
                }
                if ($(this).is("#price")){
                    if (/^[1-9][0-9]*$/.test($(this).val())){
                        hideError($(this));
                    }else {
                        formFlag = false;
                        showError($(this),'Wrong Price Input!');
                    }
                }
            }
        }else {
            isFile = 0;
            let file = this.files[0];
            let img = $("#img-preview");
            imageFlag = true;
            if (!file){
                img.addClass('hidden');
                if (isUpdate){
                    hideError($(this));
                    imageFlag = true;
                    return;
                }
                showError($(this),'Please choose an image file.');
                imageFlag = false;
                return;
            }
            if (!(/^image\/png$|jpeg$/.test(file.type))){
                img.addClass('hidden');
                showError($(this),'Please choose an image file with jpg or jpeg or png.');
                imageFlag = false;
                return;
            }
            img.removeClass('hidden');
            hideError($(this));
            let oburl = window.URL.createObjectURL(file);
            img.attr("src", oburl) ;
            isFile = 1;
        }
    });
    bt_upload.on('click',function () {
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
                        if (!(/^-?\d+$/.test($(this).val()))){
                            formFlag = false;
                            showError($(this),'Wrong Year Input!');
                        }else {
                            hideError($(this));
                        }
                    }
                    if ($(this).is("#width")||$(this).is("#height")){
                        if (/^[0-9]+(.[0-9]{1,5})$/.test($(this).val())||/^[1-9][0-9]*$/.test($(this).val())){
                            hideError($(this));
                        }else {
                            formFlag = false;
                            showError($(this),'Wrong Length input!');
                        }
                    }
                    if ($(this).is("#price")){
                        if (/^[1-9][0-9]*$/.test($(this).val())){
                            hideError($(this));
                        }else {
                            formFlag = false;
                            showError($(this),'Wrong Price Input!');
                        }
                    }
                }
            }else {
                if (!imageFlag){
                    let file = this.files[0];
                    if (!file&&isUpdate){
                        imageFlag = true;
                        isFile = 0;
                    }else {
                        showError($(this),'Please choose an image file.');
                        imageFlag = false;
                    }
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
            let title = $("#title").val();
            let artist = $("#artist").val();
            let genre = $("#genre").val();
            let year = $("#year").val();
            let width = $("#width").val();
            let height = $("#height").val();
            let description = $("#description").val();
            let price = $("#price").val();
            let file = document.getElementById("imageFile").files[0];
            let formData = new FormData();
            formData.append('type','upload');
            formData.append('title',title);
            formData.append('artist',artist);
            formData.append('genre',genre);
            formData.append('year',year);
            formData.append('width',width);
            formData.append('height',height);
            formData.append('description',description);
            formData.append('price',price);
            formData.append('isFile',isFile+"");
            if (isFile === 1){
                formData.append('file',file);
            }
            $.ajax({
                url: 'upload_handle.php',
                type: 'POST',
                cache: false,
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.success){
                        showTip('Upload successfully');
                        $('form input').each(function () {
                            if (!$(this).is("#imageFile")){
                                $(this).val("");
                            }
                        });
                        $('form textarea').each(function () {
                            $(this).val("");
                        });
                    }else {
                        showTip(result.message);
                    }
                }
            });
        }
    });
    function showError(ele,message){
        ele.siblings('div').html('<i class="fa fa-exclamation-circle fa-lg"></i> '+message);
        ele.siblings('div').removeClass('hidden');
    }
    function hideError(ele) {
        ele.siblings('div').addClass('hidden');
    }
    function showTip(message) {
        $(".tip-content").html(message);
        $("#tip").removeClass('hidden').fadeIn("fast",function () {
            $("#tip").fadeOut(2000,function () {
                $("#tip").addClass('hidden');
            });
        });
    }
});