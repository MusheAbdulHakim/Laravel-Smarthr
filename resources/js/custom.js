(function ($) {
    $(document).on("ajax:before", function () {
        $("#loader-wrapper").addClass("d-block");
        return true;
    });

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

    $(document).on("ajax:success", function (e, data) {
        $("#loader-wrapper").removeClass("d-block");
        let title = $(e.target).data("title");
        let style = $(e.target).data("style");
        let size = $(e.target).data("size");
        if ($(e.target).data("ajax-modal") === true) {
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
        }
        if ($(".select").length > 0) {
            $(".select").select2({
                minimumResultsForSearch: -1,
                width: "100%",
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
        return true;
    });
})(jQuery);
