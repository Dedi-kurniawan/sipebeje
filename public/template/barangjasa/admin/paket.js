"use strict";

function createData() {
    $("#formModal").modal("show");
}

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
    	url: HOST_URL + '/dt/admin/master/paket',  
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
            data: 'step_one',
            name: 'step_one',
            orderable: false,
            searchable: false,
        },
        {
            data: 'step_two',
            name: 'step_two',
            orderable: false,
            searchable: false,
        },
        {
            data: 'cetak',
            name: 'cetak',
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
    dt_paket.ajax.reload(null, false);
});

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
            var title = "Hapus Paket";
            var action = "delete";
            $.ajax({
                url: HOST_URL + '/admin/paket/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    finishLoading();
                    if (d.status == 'success') {
                        dt_paket.ajax.reload(null, false);
                        notifToast('warning', title, d.message);
                        return false;
                    } else if (d.status == 'error') {
                        dt_paket.ajax.reload(null, false);
                        notifToast("error", title + " GAGAL" , d.message);
                        return false;
                    }
                },
                error: function (json) {
                    dt_paket.ajax.reload(null, false);
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

$('.rupiah').mask('000.000.000.000.000,00', {
    reverse: true
});

$( "#hps" ).change(function() {
    rupiahTerbilang($("#hps").val());
});

$( "#terbilang_rupiah" ).click(function() {
    rupiahTerbilang($("#hps").val());
});

$("#cetakUndangan").click(function () {
    $("#").modal("show");
});

function rupiahTerbilang(rupiah) {
    var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#terbilang").val(terbilang);
    });
}