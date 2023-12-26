$('.deleteGameConfirm').click(function () {
    const csrf_token = $('input[name="_token"]').val();
    const gameId = $(this).data('game_id');

    Swal.fire({
        title: 'Вы действительно хотите удалить игру?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Да',
        cancelButtonText: 'Нет'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: `/admin/games/${gameId}`,
                dataType: 'json',
                success: function (response) {
                    Swal.fire({
                        title: 'Игра успешно удалена',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                },
                error: function (error) {
                    alert('Не удалось удалить игру');
                }
            });
        }
    });
});
