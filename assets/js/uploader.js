(function ($) {
    'use strict';
    jQuery.extend({
        setUploader: function(obj, type) {
            var html = '<div class="fade modal" id="uploader" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body"></div></div></div></div>';
            if($("#uploader").length == 0) {
                $('body').append(html);
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

            $("#uploader").modal();
        }
    });

    //gallery
    if(typeof blueimp == 'object') {
        $('body').append('<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>');
        $('p img').each(function(){
            var img_src = $(this).attr('src');
            var img_alt = $(this).attr('alt');
            var reg = /^\/uploads\/images\/\w/;
            if(reg.test(img_src)) {
                img_src = img_src.replace('_thumb.', '.');
            }
            $(this).wrap('<a href="' + img_src + '" title="' + img_alt + '" data-gallery></a>');
        });
    }
})(window.jQuery);