(function ($) {
    'use strict';

    $(document).ready(function () {
        
        //empty cart.
        $("#wcibd-delete-all").on("click", function () {
            $.confirm({
                title: wcibd_ajax_object.Confirm_deletion,
                icon: 'fa fa-warning',
                content: wcibd_ajax_object.really_empty,
                buttons: {
                    type: 'red',
                    typeAnimated: true,
                    confirm: {
                        btnClass: 'btn-red',
                        action: function () {
                            $.post(
                                    wcibd_ajax_object.wcibd_ajax_url,
                                    {
                                        action: "wcibd_delete_all"
                                    }, function (answer) {
                                        location.reload();
                                    }
                            );
                        }
                    },
                    cancel: function () {
                    }
                }
            });
        });
        
        /**
         * Select all checkboxes when clicking on the main one
         */
        $("#wcibd-chekall").on("click", function(){
            $(document).find(".wcibd-single-item").each( function(index){
                if( $("#wcibd-chekall").is(':checked') ){
                    $(this).attr("checked", "checked");
                }else{
                    $(this).removeAttr('checked');
                }
                
            });
        });
        
        
        //Delete selection.
        $("#wcibd-delete-selected").on("click", function () {
            $.confirm({
                title: wcibd_ajax_object.Confirm_deletion,
                icon: 'fa fa-warning',
                content: wcibd_ajax_object.really_delete,
                buttons: {
                    type: 'red',
                    typeAnimated: true,
                    confirm: {
                        btnClass: 'btn-red',
                        action: function () {
                            var data = wcfibd_retrieve_checked_items();
                            var wcibd_nonce = $('#wcibd_nonce').val();
                            $.post(
                                    wcibd_ajax_object.wcibd_ajax_url,
                                    {
                                        action: "wcibd_delete_items",
                                        data : data,
                                        wcibd_nonce : wcibd_nonce
                                    }, function (answer) {
                                        location.reload();
                                    }
                            );
                        }
                    },
                    cancel: function () {
                    }
                }
            });
        });
        
    });
    
    
    
        /**
         * Fuction to retrieve all the items to be deleted
         */
        
        function wcfibd_retrieve_checked_items(){
            var data = {};
            var selected_items = $(document).find(".wcibd-single-item");
            var i = 0;
            var j = 0;
            for (i = 0; i < selected_items.length; i++) {
                if( $( selected_items[i] ).is(':checked') ){
                    data[j] = $( selected_items[i] ).attr("data-item");
                    j++;
                }
            }
            return data;
        }
        

})(jQuery);
