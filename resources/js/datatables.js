import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5/js/buttons.bootstrap5.min.mjs';
import 'datatables.net-columncontrol-bs5/js/columnControl.bootstrap5.min.mjs'
import 'datatables.net-colreorder-bs5/js/colReorder.bootstrap5.min.mjs';
import 'datatables.net-select-bs5/js/select.bootstrap5.min.mjs';


window.DataTable = DataTable;
window.jszip = jszip;
window.pdfmake = pdfmake;

import 'laravel-datatables-vite/js/dataTables.buttons.js';
import 'laravel-datatables-vite/js/dataTables.renderers.js';

jQuery.extend(true, DataTable.defaults, {
    dom:
        "<'row'<'col-sm-12 mb-4'B>>" +
        "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
});

jQuery.extend(true, DataTable.Buttons.defaults, {
    dom: {
        buttonLiner: {
            tag: ''
        },
    },
});

jQuery.extend(DataTable.ext.classes, {
    sTable: "dataTable table table-striped table-bordered table-hover",
});
