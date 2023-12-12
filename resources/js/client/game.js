$(document).ready(function () {
    const currentPlayerId = $('[name="current_player_id"]').val();
    const partyStageId = $('[name="party_stage_id"]').val();
    const playerWinnerId = $('[name="player_winner_id"]').val();
    const playerWinnerName = $('[name="player_winner_name"]').val();

    if (playerWinnerId && playerWinnerId !== currentPlayerId) {
        Swal.fire({
            title: 'Победитель найден!',
            text: 'Игрок ' + playerWinnerName + ' нашел ответ первее',
            icon: 'warning',
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });
    }

    const answer = $('#answer').data('answer');

    $(".bubble-player").on("click", function () {
        const clickedAnswer = $(this).find('.answer').text();
        const csrf_token = $('#player_id input[name="_token"]').val();

        if (answer === clickedAnswer) {
            Swal.fire({
                title: 'Поздравляем',
                text: 'Ваш ответ верен!',
                icon: 'success',
                showConfirmButton: 'Ok',
                showCancelButton: false,
            });

            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: `/save_player_winner/${partyStageId}`,
                data: {
                    player_id: currentPlayerId,
                },
            });
        }
    });
});


