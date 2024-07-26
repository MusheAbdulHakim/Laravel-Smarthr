import "./bootstrap";
import $ from 'jquery';
window.jQuery = window.$ = $
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import sort from '@alpinejs/sort'
window.Livewire = Livewire 
window.Alpine = Alpine
Alpine.plugin(sort)
Livewire.start()

import Select2 from 'select2';
import Sortable from "sortablejs";
import moment from 'moment';
import intlTelInput from "intl-tel-input";
import nProgress from "nprogress";
import Toastify from 'toastify-js'
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import { jsPDF } from "jspdf";


window.intlTelInput = intlTelInput;
window.NProgress = nProgress;
window.moment = moment;
window.Toastify = Toastify;
window.Calendar = Calendar
window.dayGridPlugin = dayGridPlugin
window.timeGridPlugin = timeGridPlugin
window.listPlugin = listPlugin
window.Sortable = Sortable
window.jsPDF = jsPDF;
Select2();
const AppAssets = import.meta.glob([
    '../assets/fonts/**',
    '../assets/img/**',
    '../assets/css/**',
    '../assets/js/**',
    '../assets/plugins/**/**',
])
console.log(AppAssets);
$(document).on("click", ".deleteBtn", function () {
    let title = $(this).data("title");
    let url = $(this).data("route");
    let question = $(this).data("question");
    var id = $(this).data("id");
    if (id != "" && url != "") {
        $("#GeneralDeleteModal .input[name='id']").val(id);
        $("#GeneralDeleteModal form").attr("action", url);
        $("#GeneralDeleteModal .modal_title").html(title);
        $("#GeneralDeleteModal .modal_message").html(question);
        $("#GeneralDeleteModal").modal("show");
    }
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', 'a[data-ajax-modal="true"], button[data-ajax-modal="true"], div[data-ajax-modal="true"], span[data-ajax-modal="true"]', function () {
    let title = $(this).data("title");
    let style = $(this).data("style");
    let size = $(this).data("size");
    let url = $(this).data('url');
    $.ajax({
        url: url,
        beforeSend: function () {
            $("#loader-wrapper").addClass("d-block");
        },
        success: function (data) {
            if (!$("#generalModalPopup").length) {
                $("body").append(
                    $(
                        `<div class="modal custom-modal ${
                            style ? style : "fade"
                        }" id="generalModalPopup" role="dialog">
                            <div class="modal-dialog modal-dialog-centered ${
                                size ? "modal-" + size : ""
                            }" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        ${
                                            title
                                                ? '<h5 class="modal-title">' +
                                                    title +
                                                    "</h5>"
                                                : ""
                                        }
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="body"></div>
                                </div>
                            </div>
                        </div>`
                    )
                );
            }
            $("#generalModalPopup .body").html(data);
            $("#generalModalPopup").modal("show");
            $("#loader-wrapper").removeClass("d-block");
            if ($(".select").length > 0) {
                $(".select").each(function () {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>');
                    $this.select2({
                      dropdownAutoWidth: true,
                      width: '100%',
                      dropdownParent: $this.parent()
                    });
                });
            }
            if ($(".datepicker").length > 0) {
                $(".datepicker").each(function () {
                    $(this).datetimepicker({
                        format: "YYYY-MM-DD",
                        icons: {
                            up: "fa fa-angle-up",
                            down: "fa fa-angle-down",
                            next: "fa fa-angle-right",
                            previous: "fa fa-angle-left",
                        },
                    });
                });
            }
            if ($(".datetimepicker").length > 0) {
                $(".datetimepicker").each(function () {
                    $(this).datetimepicker({
                        format: "YYYY-MM-DD H:i",
                        icons: {
                            up: "fa fa-angle-up",
                            down: "fa fa-angle-down",
                            next: "fa fa-angle-right",
                            previous: "fa fa-angle-left",
                        },
                    });
                });
            }
        },
        error: function (xhr) {                
            $(".loader-wrapper").addClass('d-none');
            console.log(xhr);
            alert("something went wrong")
        }
    });
});

if ($(".datetimepicker").length > 0) {
    $(".datetimepicker").each(function () {
        $(this).datetimepicker({
            format: "YYYY-MM-DD H:i",
            icons: {
                up: "fa fa-angle-up",
                down: "fa fa-angle-down",
                next: "fa fa-angle-right",
                previous: "fa fa-angle-left",
            },
        });
    });
}