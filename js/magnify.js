(function () {
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
        var event = event || window.event;
        var pageX = event.pageX || event.clientX + document.documentElement.scrollLeft;
        var pageY = event.pageY || event.clientY + document.documentElement.scrollTop;
        var targetX = pageX - $("#box").offset().left;
        var targetY = pageY - $("#box").offset().top;
        var maskX = targetX -  mask.offsetWidth / 2;
        var maskY = targetY - mask.offsetHeight / 2;
        if (maskX < 0) {
            maskX = 0;
        }
        if (maskX > smallBox.offsetWidth - mask.offsetWidth) {
            maskX = smallBox.offsetWidth - mask.offsetWidth;
        }
        if (maskY < 0) {
            maskY = 0;
        }
        if (maskY > smallBox.offsetHeight - mask.offsetHeight) {
            maskY = smallBox.offsetHeight - mask.offsetHeight;
        }
        mask.style.left = maskX + "px";
        mask.style.top = maskY + "px";
        var bigToMove = bigImg.offsetWidth - bigBox.offsetWidth;
        var maskToMove = smallBox.offsetWidth - mask.offsetWidth;
        var rate = bigToMove / maskToMove;
        bigImg.style.left = -rate * maskX + "px";
        bigImg.style.top = -rate * maskY + "px";
        };
})();