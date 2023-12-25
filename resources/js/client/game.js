$(document).ready(function () {
    const currentPlayerId = $('[name="current_player_id"]').val();
    const partyStageId = $('[name="party_stage_id"]').val();
    const playerWinnerId = $('[name="player_winner_id"]').val();
    const playerWinnerName = $('[name="player_winner_name"]').val();
    const isPlayer = $('[name="is_player"]').val();
    const correctAnswer = $('[name="answer"]').val();

    if (!isPlayer && playerWinnerId) {
        Swal.fire({
            title: 'Победитель найден!',
            html: `Игрок <strong>${playerWinnerName}</strong> нашел ответ <br> Правильный ответ: <strong> ${correctAnswer} </strong>`,
            icon: 'success',
        });
    }

    if (isPlayer && playerWinnerId && playerWinnerId !== currentPlayerId) {
        Swal.fire({
            title: 'Победитель найден!',
            html: `Игрок <strong>${playerWinnerName}</strong> нашел ответ <br> Правильный ответ: <strong> ${correctAnswer} </strong>`,
            icon: 'warning',
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });
    }

    if (playerWinnerId && playerWinnerId === currentPlayerId) {
        Swal.fire({
            title: 'Поздравляем',
            text: 'Вы выбрали правильный вариант!',
            icon: 'success',
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });
    }

    // const answer = $('#answer').data('answer');

    let isTimerRunning = false;
    $(".bubble-player").on("click", function () {
        const clickedAnswer = $(this).find('.answer_id').val();
        const csrf_token = $('#player_id input[name="_token"]').val();

        // Проверить, не выполняется ли уже таймер
        if (isTimerRunning) {
            Swal.fire({
                title: 'Подождите',
                text: 'Можно выбрать через 3 секунды',
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: false,
                timer: 3000
            });
            return;
        }

        const clickedBubble = $(this);
        let timerValue = 3;

        const timerContainer = $('<div class="timer">3</div>');
        clickedBubble.append(timerContainer);

        const updateTimer = () => {
            timerValue -= 1;
            timerContainer.text(timerValue);

            if (timerValue <= 0) {
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    url: `/save_player_winner/${partyStageId}`,
                    data: {
                        clickedAnswer
                    }
                });

                timerContainer.remove();
                isTimerRunning = false;
            } else {
                setTimeout(updateTimer, 1000);
            }
        }

        isTimerRunning = true;
        setTimeout(updateTimer, 1000);
    });

    const party_id = $('[name="party_id"]').val();

    const channelGameParties = pusher.subscribe('gameParties.party.' + party_id);
    channelGameParties.bind('game-parties-update', function () {
        location.reload();
    });
});


