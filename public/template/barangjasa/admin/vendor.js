"use strict";

$("#kecamatan_filter").on("change", function (e) {
    return getFilterDesa($("#kecamatan_filter").val());
});

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

var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    ajax: {
        method: 'POST',
    	url: HOST_URL + '/dt/admin/master/vendor',  
        data: function (d) {
            d.kecamatan_id = $("#kecamatan_filter").val();
            d.desa_id = $("#desa_filter").val();
            d.nama_perusahaan = $("#nama_filter").val();
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
            data: 'nama_perusahaan',
            name: 'nama_perusahaan',
            orderable: false,
            searchable: false,
        },
        {
            data: 'npwp',
            name: 'npwp',
            orderable: false,
            searchable: false,
        },
        {
            data: 'telepon',
            name: 'telepon',
            orderable: false,
            searchable: false,
        },
        {
            data: 'alamat',
            name: 'alamat',
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
    }
});

$("#button_filter").on("click", function() {
    startLoadingFilter();
    table.ajax.reload();
});

$("#kecamatan_id").on("change", function (e) {
    return getDesa($("#kecamatan_id").val(), "");
});

getDesa($("#kecamatan_id").val(), $("#desa_selected").val());

function getDesa(kecamatan_id, desa_id) {
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
            $("#desa_id").html('');
            $("#desa_id").html(data.options);
            return false;
        }
    });
} 

$(document).on('click', '#deleteData', function (e) {
    e.preventDefault();
    var id   = $(this).data('id');
    var name = $(this).data('name');
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Menghapus "+name,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batal!",
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            var title = "Hapus Data";
            var action = "delete";
            $.ajax({
                url: HOST_URL + '/admin/vendor/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    finishLoading();
                    console.log(d)
                    if (d.status == 'success') {
                        table.ajax.reload(null, false);
                        notifToast("error", title, d.message);
                        return false;
                    } else if (d.status == 'error') {
                        table.ajax.reload(null, false);
                        notifToast("warning", title + " GAGAL" , d.message);
                        return false;
                    }
                },
                error: function (json) {
                    table.ajax.reload(null, false);
                    notifToast("error", title +" GAGAL" , " Minta admin untuk menghapus data");
                    return false;
                },
            });
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "Batal",
                "Kamu membatalkan  menghapus "+name,
                "error"
            )
        }
    });
});