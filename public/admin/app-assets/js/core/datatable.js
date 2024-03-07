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
                    window.location.reload();
                    notificationToast(response.data.message, 'success');
                    loaderHide();

                })
                .catch(function (error) {
                    console.log(error);
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide();
                });

        }


        integerOnly();
    }
)

