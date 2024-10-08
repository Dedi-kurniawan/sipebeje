"use strict";

var dt_undangan = $('#dt_undangan').DataTable({
    processing: true,
    serverSide: true,
    "scrollX": true,
    searching: false,
    responsive: false,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    ajax: {
        method: 'POST',
    	url: HOST_URL + '/dt/admin/master/undangan-paket',  
        data: function (d) {
            d.search = $("#search_filter").val();
            d.status = $("#status_filter").val();
        }
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'paket.desa.nama',
            name: 'paket.desa.nama',
            orderable: false,
            searchable: false,
        },
        {
            data: 'nama_kegiatan',
            name: 'nama_kegiatan',
            orderable: false,
            searchable: false,
        },
        {
            data: 'hps_format',
            name: 'hps_format',
            orderable: false,
            searchable: false,
        },
        {
            data: 'status_format',
            name: 'status_format',
            orderable: false,
            searchable: false,
        },
        {
            data: 'tanggal_selesai_format',
            name: 'tanggal_selesai_format',
            orderable: false,
            searchable: false,
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
        }
        
    ],
    columnDefs: [{
        "targets": '_all',
        "defaultContent": "-"
    }],
    "language": {
        "lengthMenu": "_MENU_",
        "zeroRecords": "DATA TIDAK ADA ",
        "info": "",
        "infoEmpty": "",
        "infoFiltered": "",
        "search": "_INPUT_",
        "searchPlaceholder": "Cari...",
        "processing":'<div class="spinner spinner-primary spinner-left mr-3">loading...</div>',
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        }
    },
    "fnDrawCallback": function() {
        var api = this.api();
        var json = api.ajax.json();
        $("#total_data").html(json.recordsTotal);
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        finishLoadingFilter();
    },
});

$("#button_filter").on("click", function () {
    startLoadingFilter();
    dt_undangan.ajax.reload(null, false);
});