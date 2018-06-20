<div id="error" class="hidden">
    <i class="fa fa-close"></i>
    <span class="error-content"></span>
</div>
<div id="tip" class="hidden">
    <i class="fa fa-check"></i>
    <span class="tip-content"></span>
</div>
<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">请确认</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="bt-confirm-delete">删除</button>
                <button type="button" class="btn btn-primary" id="bt-logout">退出登陆</button>
                <button type="button" class="btn btn-primary" id="bt-confirm" data-dismiss="modal">确认</button>
                <button type="button" class="btn btn-light" data-dismiss="modal" id="bt-confirm-cancel">取消</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-recharge">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">充值</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h6>请输入充值金额：</h6>
                <div id="div-recharge">
                    <label for="recharge-input">$</label>
                    <input type="number" step="1" min="1" id="recharge-input">
                    <div class="conflictDiv hidden"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="bt-recharge-commit">确认</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<footer class="bg-dark text-white">
    <div>Produced and maintained by Jed in April,2018.</div>
</footer>
<?php

?>