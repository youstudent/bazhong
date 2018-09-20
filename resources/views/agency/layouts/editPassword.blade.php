<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   密码修改
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/agency/index/editPassword')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">请输入新密码<span style="color: red">&nbsp;*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="password" class="form-control" id="password" placeholder="请输入新密码" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                        </button>
                        <button type="submit" class="btn btn-primary">
                            提交更改
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>