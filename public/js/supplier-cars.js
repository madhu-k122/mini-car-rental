$(document).ready(function () {
    $('.delete-btn').click(function (e) {
        e.preventDefault();
        let carId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete."`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/supplier/cars/${carId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire('Deleted!', response.message, 'success')
                            .then(() => {
                                location.reload();
                            });
                    },
                    error: function (xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Failed to delete.', 'error');
                    }
                });
            }
        });
    });

    const $modal = $('#availabilityModal');
    const $form = $('#availabilityForm');
    const openModal = () => $modal.removeClass('hidden').addClass('flex');
    const closeModal = () => $modal.addClass('hidden').removeClass('flex');
    $('.set-availability-btn').on('click', function (e) {
        e.preventDefault();
        const carCode = $(this).data('code');
        $.ajax({
            url: `/supplier/cars/${carCode}/availability`,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            dataType: 'json',
            success: function (data) {
                $form.data('carCode', carCode);
                openModal();
            },
            error: function (xhr) {
                console.error(xhr);
                Swal.fire('Error!', 'Failed to load availability data.', 'error');
            }
        });
    });

    $('#closeModal').on('click', closeModal);
    $form.on('submit', function (e) {
        e.preventDefault();
        const carCode = $(this).data('carCode');
        const formData = new FormData(this);

        $.ajax({
            url: `/supplier/cars/${carCode}/availability`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                Swal.fire('Success!', data.message, 'success');
                closeModal();
                location.reload();
            },
            error: function (xhr) {
                let msg = 'Failed to update availability.';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.message) msg = xhr.responseJSON.message;
                    if (xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    }
                }
                Swal.fire('Error!', msg, 'error');
            }
        });
    });

    $('.availability-dropdown').on('change', function () {
        var carCode = $(this).data('code');
        var newValue = $(this).val();
        $.ajax({ 
            url: `/supplier/car-availabilities/${carCode}/update-available`,
            type: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify({ a_is_available: newValue }),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    Swal.fire('Success', 'Availability updated successfully', 'success');
                } else {
                    Swal.fire('Error', data.message || 'Failed to update availability', 'error');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire('Error', 'Something went wrong', 'error');
            }
        });
    });
});
