// $('#bookingsTable').DataTable({
//     ajax: {
//         url: "{{ route('cars.bookings.list') }}",
//         type: "POST",
//         data: { _token: "{{ csrf_token() }}" }
//     },
//     columns: [
//         { data: 'car_name' },
//         { data: 'user_name' },
//         { data: 'start_date' },
//         { data: 'end_date' },
//         { data: 'status' }
//     ]
// });

$(document).ready(function () {
    $('.car-delete-btn').click(function (e) {
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
                    url: `cars/${carId}`,
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

      $('.view-booking').click(function() {
            var booking = $(this).data('booking');
            console.log(booking);
            var html = `
            <p><strong>Car:</strong> ${booking.car?.c_name ?? 'N/A'}</p>
            <p><strong>Customer:</strong> ${booking.user?.name ?? 'N/A'}</p>
            <p><strong>Start Date:</strong> ${booking.b_start_date}</p>
            <p><strong>End Date:</strong> ${booking.b_end_date}</p>
            <p><strong>Total Price:</strong> ₹${parseFloat(booking.car.c_price_per_day).toFixed(2)}</p>
            <p><strong>Status:</strong> ${booking.b_status}</p>
        `;
            $('#bookingDetails').html(html);
            $('#bookingModal').removeClass('hidden');
        });

        $('#closeModal').click(function() {
            $('#bookingModal').addClass('hidden');
        });
        $('#bookingModal').click(function(e) {
            if (e.target == this) {
                $(this).addClass('hidden');
            }
        });
});
