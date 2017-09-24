<!-- Modal -->
<div class="modal fade" id="uploader" tabindex="-1" role="dialog" aria-labelledby="uploaderLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="uploaderLabel">插入链接</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#url" data-toggle="tab">链接地址</a></li>
                    <li><a href="#upload" data-toggle="tab">上传文件</a></li>
                    <li><a href="#history" data-toggle="tab">历史文件</a></li>
                </ul>
                <div class="tab-content" style="margin-top: 10px;">
                    <div class="tab-pane fade in active" id="url">
                        <div class="form-group">
                            <label for="exampleInputEmail1">链接URL</label>
                            <input type="text" class="form-control" id="link-url" placeholder="链接URL">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">链接文本</label>
                            <input type="text" class="form-control" id="link-title" placeholder="链接文本">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="upload">
                        <!-- The file upload form used as target for the file upload widget -->
                        <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>添加文件...</span>
                                        <input type="file" name="files[]" multiple>
                                    </span>
                                    <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>开始上传</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>取消上传</span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span>删除</span>
                                    </button>
                                    <input type="checkbox" class="toggle">
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>
                                </div>
                                <!-- The global progress state -->
                                <div class="col-lg-5 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                         aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped">
                                <tbody class="files"></tbody>
                            </table>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="history">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">插入</button>
            </div>
        </div>
    </div>
</div>