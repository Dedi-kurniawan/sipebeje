"use strict";

var dt_hasil = $('#dt_hasil').DataTable({
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
    	url: HOST_URL + '/dt/admin/master/hasil-evaluasi-penawaran',  
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
            data: 'vendor.nama_perusahaan',
            name: 'vendor.nama_perusahaan',
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
            data: 'surat_penawaran',
            name: 'surat_penawaran',
            orderable: false,
            searchable: false,
        },
        {
            data: 'harga',
            name: 'harga',
            orderable: false,
            searchable: false,
        },
        {
            data: 'kesimpulan',
            name: 'kesimpulan',
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
    },
});

$("#submitData").click(function (event) {
    event.preventDefault();
    startLoading();
    var validat = $("#form_validate").valid();
    var action = $(this).val();
    if (!validat) {
        finishLoading();
        return false;
    }
    var url = HOST_URL + '/admin/hasil-evaluasi-penawaran';
    var title = "TAMBAH HASIL EVALUASI PENAWARAN";
    $.ajax({
        url: url,
        method: "POST",
        data: $('#form_validate').serialize(),
        dataType: 'json',
        error: function (json) {
            console.log(json);
            finishLoading();
            var errors = $.parseJSON(json.responseText);
            $.each(errors.errors, function (key, value) {
                $("input[name='" + key + "']").after("<label id='" + key + "-error' class='error invalid-feedback' for='" + key + "'>" + value + "</label>");
                $("input[name='" + key + "']").addClass("is-invalid");
            });
        },
        success: function (d) {
            finishLoading();
            if (d.status == 'success') {
                $("#vendor_id").val('').trigger('change');
                $("#form_validate")[0].reset();
                dt_hasil.ajax.reload(null, false);
                notifToast(action, title, d.message);
                return false;
            } else if ((d.status == 'error')) {
                $("#form_validate")[0].reset();
                dt_hasil.ajax.reload(null, false);
                notifToast(d.status, title, d.message);
                return false;
            }
        }
    });
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
            var title = "Hapus Data";
            var action = "delete";
            $.ajax({
                url: HOST_URL + '/admin/hasil-evaluasi-penawaran/' + id,
                method: "DELETE",
                dataType: 'json',
                data: {
                    paket_id : $("#paket_id").val(),
                },   
                success: function (d) {     
                    finishLoading();
                    if (d.status == 'success') {
                        dt_hasil.ajax.reload(null, false);
                        notifToast(action, title, d.message);
                        return false;
                    } else if (d.status == 'error') {
                        dt_hasil.ajax.reload(null, false);
                        notifToast("error", title + " GAGAL" , d.message);
                        return false;
                    }
                },
                error: function (json) {
                    console.log(json)
                    dt_hasil.ajax.reload(null, false);
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