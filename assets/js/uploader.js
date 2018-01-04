(function ($) {
    'use strict';
    jQuery.extend({
        setUploader: function(obj, type, url) {
            if($(".modal").length == 0) {
                $('body').append('<div class="fade modal" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"></div></div></div></div>');
            }
            $('.modal-content').load(url, function(){
                $('#fileupload').fileupload();
                var selection = obj.cm.getSelection();
                if (selection.length > 0) {
                    $('#attachment-title').val(selection);
                }
                $('.modal-footer .btn-success').on('click', function () {
                    if ($('#url').hasClass('active')) {
                        var title = $('#attachment-title').val(), url = $('#attachment-url').val();
                        if(type == 'image') {
                            var urlRegex = new RegExp('^((http|https)://|(mailto:)|(//))[a-z0-9]', 'i');
                            if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                obj.cm.replaceSelection('![' + title + '](' + url + ' "' + title + '")');
                            }
                        } else {
                            var urlRegex = new RegExp('^((http|https)://|(mailto:)|(//))[a-z0-9]', 'i');
                            if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                obj.cm.replaceSelection('[' + title + '](' + url + ')');
                            }
                        }
                    } else if ($('#upload').hasClass('active')) {
                        var links = '';
                        $('#upload .name a').each(function () {
                            var title = $(this).attr('title'), url = $(this).attr('href');
                            if(type == 'image') {
                                var urlRegex = new RegExp('^(/uploads/images/)', 'i');
                                if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                    links += '![' + title + '](' + url + ' "' + title + '")\n';
                                }
                            } else {
                                var urlRegex = new RegExp('^(/attachment/download)', 'i');
                                if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                    links += '[' + title + '](' + url + ')\n';
                                }
                            }
                        });
                        obj.cm.replaceSelection(links);
                    } else {
                        //TODO 选择历史文件
                    }
                });
            });
            $(".modal").modal();
        }
    });
})(window.jQuery);
