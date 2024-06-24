import "./bootstrap";
import "jquery-ujs";
import intlTelInput from "intl-tel-input";
import nProgress from "nprogress";
import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from "datatables.net-bs5";
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-colreorder-bs5';


window.DataTable = DataTable;
window.intlTelInput = intlTelInput;
window.NProgress = nProgress;

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

$(document).on('ajax:before', function(){
    $('#loader-wrapper').addClass('d-block')
    return true;
})

$(document).on("ajax:success", function (e, data) {
    $('#loader-wrapper').removeClass('d-block')
    let title = $(e.target).data("title");
    let style = $(e.target).data("style");
    let size = $(e.target).data("size");
    if ($(e.target).data("ajax-modal") === true) {
        if (!$("#generalModal").length) {
            $("body").append(
                $(
                    `<div class="modal custom-modal ${
                        style ? style : "fade"
                    }" id="generalModal" role="dialog">
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
        $("#generalModal .body").html(data);
        $("#generalModal").modal("show");
    }
});
