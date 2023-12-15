$(document).ready(function () {
    const currentPlayerId = $('[name="current_player_id"]').val();
    const partyStageId = $('[name="party_stage_id"]').val();
    const playerWinnerId = $('[name="player_winner_id"]').val();
    const playerWinnerName = $('[name="player_winner_name"]').val();

    if (playerWinnerId && playerWinnerId !== currentPlayerId) {
        Swal.fire({
            title: 'Победитель найден!',
            text: 'Игрок ' + playerWinnerName + ' нашел ответ',
            icon: 'warning',
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });
    }

    if (playerWinnerId && playerWinnerId === currentPlayerId) {
        Swal.fire({
            title: 'Поздравляем',
            text: 'Ваш ответ верен!',
            icon: 'success',
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });
    }

    const answer = $('#answer').data('answer');

    let isTimerRunning = false;
    $(".bubble-player").on("click", function () {
        // Проверить, не выполняется ли уже таймер
        if (isTimerRunning) {
            return;
        }

        const clickedBubble = $(this);
        let timerValue = 3;

        const $timerContainer = $('<div class="timer">3</div>');
        clickedBubble.append($timerContainer);

        const clickedAnswer = $(this).find('.answer').text();
        const csrf_token = $('#player_id input[name="_token"]').val();

        const updateTimer = () => {
            timerValue -= 1;
            $timerContainer.text(timerValue);

            if (timerValue <= 0) {
                if (answer === clickedAnswer) {
                    Swal.fire({
                        title: 'Поздравляем',
                        text: 'Ваш ответ верен!',
                        icon: 'success',
                        showConfirmButton: false,
                        showCancelButton: false,
                        allowOutsideClick: false
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
                $timerContainer.remove();
                isTimerRunning = false;
            } else {
                setTimeout(updateTimer, 1000);
            }
        }

        isTimerRunning = true;
        setTimeout(updateTimer, 1000);
    });

    const party_id = $('#party_id').val();

    console.log(party_id)
    const channelGameParties = pusher.subscribe('gameParties.party.' + party_id);
    channelGameParties.bind('game-parties-update', function () {
        console.log('websocket');
        location.reload();
    });
});


