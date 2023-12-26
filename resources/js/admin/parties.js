$(document).ready(function () {
    $(document).ready(function () {
        $(".copyBtnPlayerUuid, .copyBtnModeratorUuid").click(function () {
            // Находим индекс кнопки
            const index = $(this).data("index");

            // Формируем ID соответствующего input
            const inputId = $(this).hasClass("copyBtnPlayerUuid") ? "#playerUuid" + index : "#moderatorUuid" + index;

            // Выбираем текст в input
            $(inputId).select();
            $(inputId)[0].setSelectionRange(0, 99999);

            // Копируем текст в буфер обмена
            document.execCommand("copy");
        });
    });
    $('.finishGameConfirm').click(function () {
        const csrf_token = $('input[name="_token"]').val();
        const partyId = $(this).data('party_id');

        Swal.fire({
            title: 'Вы хотите завершить игру?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    url: `/admin/finish_game/${partyId}`,
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            title: 'Игра успешно завершена',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    },
                    error: function (error) {
                        alert('Не удалось изменить статус');
                    }
                });
            }
        });
    });
});
