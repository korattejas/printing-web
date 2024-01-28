$(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        if ($('table').hasClass('dt-column-search')) {
            let dt_filter_table = $('.dt-column-search');
            // Setup - add a text input to each footer cell
            $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
            $('.dt-column-search thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                if (!$(this).attr("data-search")) {
                    if (!$(this).attr("data-stuff")) {
                        $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
                        $('input', this).on('keyup change', function () {
                            if (dt_filter.columns(i).search() !== this.value) {
                                dt_filter.columns(i).search(this.value).draw();
                            }
                        });
                    } else {
                        var data_attribute_array = $(this).attr("data-stuff").split(",");
                        var oselect_text = '<option value="">All</option>';

                        $.each(data_attribute_array, function (index, value) {
                            oselect_text += '<option value="' + value + '">' + value + '</option>';
                        });

                        $(this).html('<select type="text" class="form-control form-control-sm">' + oselect_text + '</select>');
                        $('select', this).on('keyup change', function () {
                            if (dt_filter.columns(i).search() !== this.value) {
                                dt_filter.columns(i).search(this.value).draw();
                            }
                        });
                    }
                } else if (!$(this).attr("data-search") && $(this).attr("data-checkbox")) {
                    $(this).html('<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="check_all" value="checked"  /></div>');
                    $('#check_all', this).on('keyup click', function () {
                        if (dt_filter.columns(i).search() !== this.value) {
                            dt_filter.columns(i).search(this.value).draw();
                        }
                    });
                } else {
                    $(this).html('-');
                }
            });
            var dt_filter = dt_filter_table.DataTable({

                processing: true,
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                ajax:
                    {
                        "url": APP_URL + datatable_url,

                    },
                orderCellsTop: true,
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });

        }


        $(document).on('click', '.delete-single', function () {
            const value_id = $(this).data('id')

            Swal.fire({
                title: sweetalert_delete_title,
                text: sweetalert_delete_text,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: delete_button_text,
                cancelButtonText: cancel_button_text,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteRecord(value_id)
                }
            });
        })

        function deleteRecord(value_id) {
            loaderView();
            axios
                .delete(APP_URL + form_url + '/' + value_id)
                .then(function (response) {
                    dt_filter.ajax.reload();
                    notificationToast(response.data.message, 'success');
                    loaderHide();

                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide();
                });

        }

        $(document).on('click', '.status-change', function () {
            const value_id = $(this).data('id');
            const status = $(this).data('change-status');
            Swal.fire({
                title: sweetalert_change_status,
                text: sweetalert_change_status_text,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: yes_change_it,
                cancelButtonText: cancel_button_text,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false,
                showClass: {
                    popup: 'animate__animated animate__flipInX'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    changeStatus(value_id, status)
                }
            });

        });

        const changeStatus = (value_id, status) => {
            loaderView();
            axios
                .get(APP_URL + form_url + '/status' + '/' + value_id + '/' + status)
                .then(function (response) {
                    dt_filter.ajax.reload();
                    notificationToast(response.data.message, 'success');
                    loaderHide();
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning');
                    loaderHide();
                });
        }

        $(document).on('click', '.detail-button', function () {
            const value_id = $(this).data('id');
            loaderView();
            axios
                .get(APP_URL + modal_url + '/' + value_id)
                .then(function (response) {
                    $('#details_modal_title').html(response.data.modal_title);
                    $('#details_modal_body').html(response.data.data);
                    $('#detailsModal').modal('show')
                    loaderHide();
                })
                .catch(function (error) {
                    loaderHide();
                    console.log(error)
                });
        });

        integerOnly();
    }
)

// Datepicker for advanced filter
var separator = ' - ',
    rangePickr = $('.flatpickr-range'),
    dateFormat = 'MM/DD/YYYY';
var options = {
    autoUpdateInput: false,
    autoApply: true,
    locale: {
        format: dateFormat,
        separator: separator
    },
    opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
};

//
if (rangePickr.length) {
    rangePickr.flatpickr({
        mode: 'range',
        dateFormat: 'm/d/Y',
        onClose: function (selectedDates, dateStr, instance) {
            var startDate = '',
                endDate = new Date();
            if (selectedDates[0] != undefined) {
                startDate =
                    selectedDates[0].getMonth() + 1 + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
                $('.start_date').val(startDate);
            }
            if (selectedDates[1] != undefined) {
                endDate =
                    selectedDates[1].getMonth() + 1 + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
                $('.end_date').val(endDate);
            }
            $(rangePickr).trigger('change').trigger('keyup');
        }
    });
}

// Advance filter function
// We pass the column location, the start date, and the end date
var filterByDate = function (column, startDate, endDate) {
    // Custom filter syntax requires pushing the new filter to the global filter array
    $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
        var rowDate = normalizeDate(aData[column]),
            start = normalizeDate(startDate),
            end = normalizeDate(endDate);

        // If our date from the row is between the start and end
        if (start <= rowDate && rowDate <= end) {
            return true;
        } else if (rowDate >= start && end === '' && start !== '') {
            return true;
        } else if (rowDate <= end && start === '' && end !== '') {
            return true;
        } else {
            return false;
        }
    });
};

// converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing
// dates easier. ex: 20131220 > 20121220
var normalizeDate = function (dateString) {
    var date = new Date(dateString);
    var normalized =
        date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
    return normalized;
};
