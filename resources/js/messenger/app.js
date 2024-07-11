
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import LazyLoad from "vanilla-lazyload";

/**
 * Next, we define a few global options for toastr, autolinker, and datatables
 */

window.LazyImages = new LazyLoad({
    elements_selector: ".lazy"
});

import.meta.glob("./css/style.scss")

toastr.options = {
    "progressBar": true,
    "closeButton" : true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "100",
    "hideDuration": "500",
    "timeOut": "1700",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    "closeHtml" : "<button><i class=\"fas fa-times\"></i></button>"
};
window.autolinker = new Autolinker({
    urls : {
        schemeMatches : true,
        wwwMatches : true,
        tldMatches : true
    },
    email : true,
    phone : false,
    mention : false,
    hashtag : false,
    stripPrefix : true,
    stripTrailingSlash : true,
    newWindow : true,
    truncate : {
        length : 50,
        location : 'smart'
    }
});

$.extend( true, $.fn.dataTable.defaults, {
    "drawCallback": function(settings){
        let api = new $.fn.DataTable.Api(settings), pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        pagination.toggle(api.page.info().pages > 1);
        $(this).find('tr').last().find(".dropdown").addClass('dropup');
        LazyImages.update();
    }
});

