$(document).ready(function () {
    $(".page-link").on('click',pageLink);
    function pageLink() {
        let message = this.getAttribute('data-target');
        let pageIndex = document.getElementById('search-pagination').getAttribute("data-index");
        let sch = location.search;
        $.post('turnpage.php'+sch,{
            'message':message,
            'pageIndex':pageIndex
        },function (result) {
            let itemBox = $("#item-box");
            result = JSON.parse(result);
            document.getElementById('search-pagination').setAttribute('data-index',result.pageIndex);
            itemBox.html("");
            let text = "";
            for (let i = 0; i < result.numOfItems; i++){
                let info = result.pageInfo[i+""];
                text += '<div class="item">\n' +
                    '            <figure>\n' +
                    '                <a href="detail.php?itemID='+info.artworkID+'"><img src="resources/img/'+info.imageFileName+'"></a>\n' +
                    '            </figure>\n' +
                    '            <div class="item-name">\n' +
                    '                <h3>'+info.title+'</h3>\n' +
                    '                <p>'+info.artist+'</p>\n' +
                    '            </div>\n' +
                    '            <p>'+info.description+'</p>\n' +
                    '            <div>\n' +
                    '                <a class="item-button" href="detail.php?itemID='+info.artworkID+'">查看</a>\n' +
                    '                <a class="item-button">热度<span class="heat-number">'+info.view+'</span> </a>\n' +
                    '            </div>\n' +
                    '        </div>';
            }
            itemBox.html(text);
            let searchPagination = $("#search-pagination");
            searchPagination.html("");
            text = "";
            text = '<li class="page-item'+((result.pageIndex === 0)?' disabled':'')+'"><a class="page-link" data-target="down">Previous</a></li>\n';
            if (result.pageIndex >= 3){
                text += '<li class="page-item"><a class="page-link" data-target="'+(result.pageIndex - 3)+'">...</a></li>\n';
                for (let i = result.pageIndex - 2; i < result.pageIndex; i++){
                    text += '<li class="page-item"><a class="page-link" data-target="'+(i)+'">'+(i+1)+'</a></li>\n';
                }
            }
            else {
                for (let i = 0; i < result.pageIndex; i++){
                    text += '<li class="page-item"><a class="page-link" data-target="'+(i)+'">'+(i+1)+'</a></li>\n';
                }
            }
            text += '<li class="page-item active"><a class="page-link" data-target="'+result.pageIndex+'">'+(result.pageIndex+1)+'</a></li>\n';
            if (result.pageNum - result.pageIndex > 3){
                for (let i = result.pageIndex + 1; i < result.pageIndex + 3; i++){
                    text += '<li class="page-item"><a class="page-link" data-target="'+(i)+'">'+(i+1)+'</a></li>\n';
                }
                text += '<li class="page-item"><a class="page-link" data-target="'+(result.pageIndex + 3)+'">...</a></li>\n';
                text += '<li class="page-item"><a class="page-link" data-target="'+(result.pageNum-1)+'">'+(result.pageNum)+'</a></li>\n';
            }
            else {
                for (let i = result.pageIndex + 1; i < result.pageNum; i++){
                    text += '<li class="page-item"><a class="page-link" data-target="'+(i)+'">'+(i+1)+'</a></li>\n';
                }
            }
            text += '<li class="page-item'+((result.pageIndex === (result.pageNum - 1))?' disabled':'')+'"><a class="page-link" data-target="up">Next</a></li>\n';
            searchPagination.html(text);
            $(".page-link").on('click',pageLink);
        });
    }
    $(".sort").on('change', function () {
        let sortType = this.getAttribute('value');
        let search = setQueryVariable('sort',sortType);
        location.assign('search.php'+search);
    });
    function getQueryVariable(variable)
    {
        let query = window.location.search.substring(1);
        let vars = query.split("&");
        for (let i=0;i<vars.length;i++) {
            let pair = vars[i].split("=");
            if(pair[0] === variable){
                return pair[1];
            }
        }
        return false;
    }
    function setQueryVariable(name, value) {
        let newQuery = "?";
        let isInsert = false;
        let query = window.location.search.substring(1);
        let vars = query.split("&");
        for (let i=0;i<vars.length;i++) {
            if (i !== 0){
                newQuery+="&";
            }
            let pair = vars[i].split("=");
            if(pair[0] === name){
                newQuery+=name+"="+value;
                isInsert = true;
            }else {
                newQuery+=vars[i];
            }
        }
        if (!isInsert){
            newQuery += "&"+name+"="+value;
        }
        return newQuery;
    }
});