"use strict";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function notifToast(action, title, message) {
    $.toast({
        text: message,
        heading: title, 
        icon: action, 
        showHideTransition: 'fade', 
        allowToastClose: true, // Boolean value true or false
        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        textAlign: 'left',  
        loader: true,  
        loaderBg: '#9EC600',  
        beforeShow: function () {}, // will be triggered before the toast is shown
        afterShown: function () {}, // will be triggered after the toat has been shown
        beforeHide: function () {}, // will be triggered before the toast gets hidden
        afterHidden: function () {}  // will be triggered after the toast has been hidden
    });
}

$("#form_validate").validate({
    // errorElement: 'div',
    ignore: ".ignore",
    errorPlacement: function (error, element) {
    error.addClass("invalid-feedback");
        if(element.hasClass('selectFormClass') && element.next('.select2-container').length) {
            error.insertAfter(element.next('.select2-container'));
        } 
        else if(element.hasClass('selectForm') && element.next('.select2-container').length) {
            error.insertAfter(element.next('.select2-container'));
        }
        else if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        }
        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
            error.insertAfter(element.parent().parent());
        }
        else if (element.prop('type') === 'radio') {
            error.insertAfter(element.parent());
        }
        else if (element.attr("id") == "description") {
            error.insertAfter(".ck-editor");
        }
        else {
            error.insertAfter(element);
        }
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
});

$("#form_validate_modal").validate({
    // errorElement: 'div',
    ignore: ".ignore",
    errorPlacement: function (error, element) {
    error.addClass("invalid-feedback");
        if(element.hasClass('selectFormClass') && element.next('.select2-container').length) {
            error.insertAfter(element.next('.select2-container'));
        } 
        else if(element.hasClass('selectForm') && element.next('.select2-container').length) {
            error.insertAfter(element.next('.select2-container'));
        }
        else if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        }
        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
            error.insertAfter(element.parent().parent());
        }
        else if (element.prop('type') === 'radio') {
            error.insertAfter(element.parent());
        }
        else if (element.attr("id") == "description") {
            error.insertAfter(".ck-editor");
        }
        else {
            error.insertAfter(element);
        }
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
});

$.validator.messages.required = function (param, input) {
    return 'kolom ' + input.id.replaceAll("_", " ") + ' di larang kosong';
}

jQuery.extend(jQuery.validator.messages, {
    email: "Silakan masukkan format email yang benar.",
	url: "Silakan masukkan format URL yang benar.",
	date: "Silakan masukkan format tanggal yang benar.",
	dateISO: "Silakan masukkan format tanggal(ISO) yang benar.",
	number: "Silakan masukkan angka yang benar.",
	digits: "Harap masukan angka saja.",
	creditcard: "Harap masukkan format kartu kredit yang benar.",
	equalTo: "Harap masukkan nilai yg sama dengan sebelumnya.",
	maxlength: $.validator.format( "Input dibatasi hanya {0} karakter." ),
	minlength: $.validator.format( "Input tidak kurang dari {0} karakter." ),
	rangelength: $.validator.format( "Panjang karakter yg diizinkan antara {0} dan {1} karakter." ),
	range: $.validator.format( "Harap masukkan nilai antara {0} dan {1}." ),
	max: $.validator.format( "Harap masukkan nilai lebih kecil atau sama dengan {0}." ),
	min: $.validator.format( "Harap masukkan nilai lebih besar atau sama dengan {0}." )
});

$('#formModal').on('hidden.bs.modal', function () {
    $('#formModal form')[0].reset();
    $(".selectForm").val("").trigger("change");
    $(".selectForm").val("").trigger("change");
    $("#form_validate").valid();
    $('input').removeClass("is-valid").removeClass("is-invalid");
    $('.selectForm').removeClass("is-valid").removeClass("is-invalid");
    $('.radio-inline').removeClass("is-valid").removeClass("is-invalid");
});

function startLoading() {
    $('#submitData').html("<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span>Loading...");
}

function finishLoading() {
    $('#submitData').html("");
    if ($('#submitData').val() == "add") {
        $("#submitData").html('<i class="fa fa-save"></i> Simpan');
    } else if ($('#submitData').val() == "edit") {
        $("#submitData").html('<i class="fa fa-edit"></i> Ubah');
    }
    $("#submitData").html('<i class="fa fa-save"></i> Simpan');
}

function startLoadingFilter() {
    $('#button_filter').html("<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span>Loading...");
}

function finishLoadingFilter() {
    $('#button_filter').html("");
    $("#button_filter").html('<i class="fa fa-search"></i> Cari');
}

$('.selectFormClass').select2({
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
}).on("change", function (e) {
    $(this).valid()
});


$('.selectForm').select2({
    dropdownParent: $("#formModal"),
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
}).on("change", function (e) {
    $(this).valid()
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