(function ($) {
    'use strict';
    jQuery.extend({
        setUploader: function(obj, type) {
            if($(".modal").length == 0) {
                $('body').append('<div class="fade modal" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"></div></div></div></div>');
            }

            $('.modal-content').load('/attachment/' + type, function(){
                $('#fileupload').fileupload();
                if(type == 'image') {
                    var selection = obj.cm.getSelection();
                    if (selection.length > 0) {
                        $('#image-title').val(selection);
                    }
                    $('.modal-footer .btn-success').on('click', function () {
                        if ($('#url').hasClass('active')) {
                            var title = $('#image-title').val();
                            var url = $('#image-url').val();
                            var urlRegex = new RegExp('^((http|https)://|(mailto:)|(//))[a-z0-9]', 'i');
                            if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                obj.cm.replaceSelection('![' + title + '](' + url + ' "' + title + '")');
                            }
                        } else if ($('#upload').hasClass('active')) {
                            var links = '';
                            $('#upload .name a').each(function () {
                                title = $(this).attr('title');
                                url = $(this).attr('href');
                                var urlRegex = new RegExp('^(/uploads/images/)', 'i');
                                if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                    links += '![' + title + '](' + url + ' "' + title + '")\n';
                                }
                            });
                            if (links !== '') {
                                obj.cm.replaceSelection(links);
                            }
                        } else {
                            //TODO 选择历史文件
                        }
                    });
                } else {
                    var selection = obj.cm.getSelection();
                    if (selection.length > 0) {
                        $('#link-title').val(selection);
                    }
                    $('.modal-footer .btn-success').on('click', function () {
                        if ($('#url').hasClass('active')) {
                            var title = $('#link-title').val();
                            var url = $('#link-url').val();
                            var urlRegex = new RegExp('^((http|https)://|(mailto:)|(//))[a-z0-9]', 'i');
                            if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                obj.cm.replaceSelection('[' + title + '](' + url + ')');
                            }
                        } else if ($('#upload').hasClass('active')) {
                            var links = '';
                            $('#upload .name a').each(function () {
                                title = $(this).attr('title');
                                url = $(this).attr('href');
                                var urlRegex = new RegExp('^(/attachment/download)', 'i');
                                if (url !== null && url !== '' && url !== 'http://' && urlRegex.test(url)) {
                                    links += '[' + title + '](' + url + ')\n';
                                }
                            });
                            if (links !== '') {
                                obj.cm.replaceSelection(links);
                            }
                        } else {
                            //TODO 选择历史文件
                        }
                    });
                }
            });

            $(".modal").modal();
        }
    });
})(window.jQuery);
