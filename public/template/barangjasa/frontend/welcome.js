$('#datatable').DataTable({
    processing: true,
    serverSide: false,
    responsive: true,
    scrollX: true,
    autoWidth: true,
    searching: false, 
    paging: false, 
    info: false,
    "deferRender": true,
    "bSortClasses": false,
    "pageLength": 50,
    "lengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "Semua"]
    ],
    "language": {
        "lengthMenu": "<div class='ml-2 mt-2'> _MENU_ </div>",
        "zeroRecords": "DATA TIDAK ADA ",
        "info": "",
        "infoEmpty": "",
        "infoFiltered": "",
        "search": "<div class='mr-2 mt-2'>cari : _INPUT_ </div>",
        "searchPlaceholder": "Cari...",
        "processing":'<div class="spinner spinner-primary spinner-left mr-3">loading...</div>',
        paginate: {
            previous: "<",
            next: ">"
        }
    }
});

$('.select_filter').select2({
    container: "body",
    width: '100%',
    selectOnClose: false,
    language: {
        noResults: function() {
          return '<a href="#">Data tidak di temukan</a>';
        },
      },
      escapeMarkup: function(markup) {
        return markup;
      },
});

$("#kecamatan_filter").on("change", function (e) {
    return getFilterDesa($("#kecamatan_filter").val());
});

getFilterDesa($("#kecamatan_filter").val(), "");

function getFilterDesa(kecamatan_id, desa_id) {
    $.ajax({
        url: HOST_URL + '/get-desa',
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