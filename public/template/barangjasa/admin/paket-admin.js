"use strict";

var dt_paket = $('#dt_paket').DataTable({
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
    	url: HOST_URL + '/dt/admin/master/paket-admin',  
        data: function (d) {
            d.nama = $("#nama_filter").val();
            d.status = $("#status_filter").val();
            d.desa_id = $("#desa_filter").val();
        }         
    },
    columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'desa.nama',
            name: 'desa.nama',
            orderable: false,
            searchable: false,
        },
        {
            data: 'nama_format',
            name: 'nama_format',
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
            data: 'cetak',
            name: 'cetak',
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
    dt_paket.ajax.reload(null, false);
});

$("#kecamatan_filter").on("change", function (e) {
    return getFilterDesa($("#kecamatan_filter").val());
});

getFilterDesa($("#kecamatan_filter").val(), $("#desa_filter_value").val());

function getFilterDesa(kecamatan_id, desa_id) {
    $.ajax({
        url: HOST_URL + '/admin/get-desa',
        method: "GET",
        data: {
            kecamatan_id : kecamatan_id,
            desa_id : desa_id,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#desa_filter").html('');
            $("#desa_filter").html(data.options);
            return false;
        }
    });
} 