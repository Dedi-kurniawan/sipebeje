"use strict";

$('.rupiah').mask('000.000.000.000.000,00', {
    reverse: true
});

var dt_vendor = $('#dt_vendor').DataTable({
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
    	url: HOST_URL + '/dt/admin/master/undangan-vendor',
        data: function (d) {
            d.undangan_id = $("#undangan_id").val();
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

getVendor($("#desa_id").val());        

$("#desa_id").change(function () {
    getVendor($("#desa_id").val());
});

function getVendor(desa_id) {
    var url   = HOST_URL + '/admin/get-vendor?desa_id='+ desa_id;
    $.get(url, function (d) {
        $("#vendor_id").html('');
        $("#vendor_id").html(d.options);
        return false;
    });
}

$("#addVendor").click(function (event) {
    event.preventDefault();
    startLoading();
    var url = HOST_URL + '/admin/add-vendor';
    var title = "TAMBAH VENDOR";
    $.ajax({
        url: url,
        method: "POST",
        data: {
            '_token'      : $('meta[name="csrf-token"]').attr('content'),
            'vendor_id'   : $("#vendor_id").val(),
            'undangan_id' : $("#undangan_id").val(),    
            'paket_id'    : $("#paket_id").val(), 
        },
        dataType: 'json',
        error: function (json) {
            console.log(json);
            var errors = $.parseJSON(json.responseText);
            $.each(errors.errors, function (key, value) {
                if (key == "vendor_id") {
                    $("#vendor_id_error").html(value);
                }                
            });
        },
        success: function (d) {
            if (d.status == 'success') {
                console.log(d.message)
                dt_vendor.ajax.reload(null, false);
                notifToast(d.status, title, d.message);
                $("#vendor_id_error").html("");
                return false;
            } else if ((d.status == 'error')) {
                dt_vendor.ajax.reload(null, false);
                notifToast(d.status, title, d.message);
                return false;
            }
        }
    });
});

$(document).on('click', '#deleteVendor', function (e) {
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
                url: HOST_URL + '/admin/delete-vendor/' + id,
                method: "DELETE",
                dataType: 'json',
                success: function (d) {
                    if (d.status == 'success') {
                        dt_vendor.ajax.reload(null, false);
                        notifToast("error", title, d.message);
                        return false;
                    } else if (d.status == 'error') {
                        dt_vendor.ajax.reload(null, false);
                        notifToast("warning", title + " GAGAL" , d.message);
                        return false;
                    }
                },
                error: function (json) {
                    dt_vendor.ajax.reload(null, false);
                    notifToast("error", title +" GAGAL" , " Terjadi Kesalah Pada Server, Mohon Di Ulangi");
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

//undangan material
var dt_material = $('#dt_material').DataTable({
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
    	url: HOST_URL + '/dt/admin/master/hps',   
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
            data: 'uraian',
            name: 'uraian',
            orderable: false,
            searchable: false,
        },
        {
            data: 'volume',
            name: 'volume',
            orderable: false,
            searchable: false,
        },
        {
            data: 'satuan',
            name: 'satuan',
            orderable: false,
            searchable: false,
        }        
    ],
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
        $("#nilai_total").val(json.total_harga_satuan);       
        rupiahTerbilang(json.total_harga_satuan);
    },
});

// function addMaterial(){
//     $(".modal-title").html("FORMULIR TAMBAH DATA PENGADAAN MATERIAL/JASA");
//     $("#submitData").val("add");
//     $(".method-hidden").html("");
//     $("#submitData").html('<i class="fa fa-save"></i> Simpan');
//     $("#formModal").modal("show");
// }

// $("#submitData").click(function (event) {
//     event.preventDefault();
//     startLoading();
//     var validat = $("#form_validate_modal").valid();
//     var action = $(this).val();
//     if (!validat) {
//         finishLoading();
//         return false;
//     }
//     var url = HOST_URL + '/admin/add-material';
//     var title = "TAMBAH DATA";
//     $.ajax({
//         url: url,
//         method: "POST",
//         data: $('#form_validate_modal').serialize(),
//         dataType: 'json',
//         error: function (json) {
//             console.log(json);
//             finishLoading();
//             var errors = $.parseJSON(json.responseText);
//             $.each(errors.errors, function (key, value) {
//                 $("input[name='" + key + "']").after("<label id='" + key + "-error' class='error invalid-feedback' for='" + key + "'>" + value + "</label>");
//                 $("input[name='" + key + "']").addClass("is-invalid");
//             });
//         },
//         success: function (d) {
//             finishLoading();
//             if (d.status == 'success') {
//                 console.log(d.message)
//                 $("#formModal").modal("hide");
//                 $("#form_validate_modal")[0].reset();
//                 $(".method-hidden").html("");
//                 dt_material.ajax.reload(null, false);
//                 notifToast(action, title, d.message);
//                 return false;
//             } else if ((d.status == 'error')) {
//                 $("#formModal").modal("hide");
//                 $("#form_validate_modal")[0].reset();
//                 $(".method-hidden").html("");
//                 dt_material.ajax.reload(null, false);
//                 notifToast(d.status, title, d.message);
//                 return false;
//             }
//         }
//     });
// });

// $(document).on('click', '#undanganMaterial', function (e) {
//     e.preventDefault();
//     var id   = $(this).data('id');
//     var name = $(this).data('name');
//     Swal.fire({
//         title: "Apakah kamu yakin?",
//         text: "Menghapus "+name,
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya, Hapus!",
//         cancelButtonText: "Tidak, Batal!",
//         reverseButtons: true
//     }).then(function (result) {
//         if (result.value) {
//             var title = "Hapus Data";
//             var action = "delete";
//             $.ajax({
//                 url: HOST_URL + '/admin/delete-material/' + id,
//                 method: "DELETE",
//                 dataType: 'json',
//                 success: function (d) {
//                     if (d.status == 'success') {
//                         dt_material.ajax.reload(null, false);
//                         notifToast("error", title, d.message);
//                         return false;
//                     } else if (d.status == 'error') {
//                         dt_material.ajax.reload(null, false);
//                         notifToast("warning", title + " GAGAL" , d.message);
//                         return false;
//                     }
//                 },
//                 error: function (json) {
//                     dt_material.ajax.reload(null, false);
//                     notifToast("error", title +" GAGAL" , " Terjadi Kesalah Pada Server, Mohon Di Ulangi");
//                     return false;
//                 },
//             });
//         } else if (result.dismiss === "cancel") {
//             Swal.fire(
//                 "Batal",
//                 "Kamu membatalkan  menghapus "+name,
//                 "error"
//             )
//         }
//     });
// });


// $( "#nilai_total" ).change(function() {
//     rupiahTerbilang($("#nilai_total").val());    
// });

// $( "#terbilang_rupiah" ).click(function() {
//     rupiahTerbilang($("#nilai_total").val());    
// });

function rupiahTerbilang(rupiah) {
    var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
    $.get(url, function (d) {
        var terbilang = d.rupiah+ " rupiah";
        $("#terbilang").val(terbilang);
    });
}