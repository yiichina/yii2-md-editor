(function ($) {
    'use strict';
    jQuery.extend({
        setUploader: function(obj, type) {
            if(type == 'image') {

            }
            $.showModal();
            $('#fileupload').fileupload();
        },
        showModal: function() {
            var html =  '<div id="modalWindow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
            html += '<div class="modal-dialog">';
            html += '<div class="modal-content">';
            html += '<div class="modal-header">';
            html += '<a class="close" data-dismiss="modal">×</a>';
            html += '<h4></h4>'
            html += '</div>';
            html += '<div class="modal-body">';
            html += '</div>';
            html += '<div class="modal-footer">';
            html += '<span class="btn" data-dismiss="modal">';
            html += '</span>'; // close button
            html += '</div>';  // footer
            html += '</div>';  // content
            html += '</div>';  // dialog
            html += '</div>';  // modalWindow
            if ( $("#someID").length == 0 ) {
                $('body').append(html);
            }
            $('.modal-content').load('/attachment/image');
            $("#modalWindow").modal();
        },
        hideModal: function() {

        }
    });
})(window.jQuery);