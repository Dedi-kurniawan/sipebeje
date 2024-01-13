"use strict";

var dt_undangan = $('#dt_undangan').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    searching: false, 
    paging: false, 
    info: false,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    ajax: {
        method: 'POST',
    	url: HOST_URL + '/dt/admin/master/cetak-undangan',  
        data: function (d) {
            d.paket_id = $("#paket_id").val();
        }         
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'vendor.desa.nama',
            name: 'vendor.desa.nama',
            orderable: false,
            searchable: false,
        },
        {
            data: 'vendor.nama_perusahaan',
            name: 'vendor.nama_perusahaan',
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
        $("#total_data_vendor").html(json.recordsTotal);
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
    },
});