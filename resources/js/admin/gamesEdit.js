$(document).ready(function () {
    let isStep1Valid = false;
    const answers = $('#answers').data('answers');

    // Выключение кнопки next-step, если поля game_title и rounds_quantity не заполнены
    function validatedStep1() {
        isStep1Valid = $('#game_title').val().trim() !== '' && $('#rounds_quantity').val().trim() !== '';
        $('#next-step').prop('disabled', !isStep1Valid);
    }

    validatedStep1();

    $('#game_title, #rounds_quantity').on('input', function () {
        validatedStep1();
    });

    $('.addQuestion').click(function () {
        // Добавление вопроса
        const roundContainer = $(this).closest('.round');
        const questionInputContainer = $('<div>').addClass('question mb-1 mt-2 d-flex align-items-center');
        const roundName = roundContainer.find('input[name^="rounds["]').attr('name');
        const roundIndex = roundName.match(/\[(\d+)\]/)[1];

        const questionInput = $('<input>')
            .attr('type', 'text')
            .attr('name', `questions[${roundIndex}]['0']`)
            .addClass('form-control form-control-sm col me-1')
            .attr('placeholder', 'Введите вопрос');

        const answerInput = $('<select>')
            .attr('name', `answer_ids[${roundIndex}]['0']`)
            .addClass('form-select form-select-sm col me-1')
            .attr('placeholder', 'Выберите ответ');
        // Добавление пустого варианта
        answerInput.append($('<option>')
            .attr('disabled', true)
            .attr('selected', true)
            .attr('value', '')
            .text('Выберите ответ'));
        answers.forEach(function (answer) {
            answerInput.append($('<option>').attr('value', answer.id).text(answer.answer_title));
        });

        const pointsInput = $('<input>')
            .attr('type', 'number')
            .attr('name', `points[${roundIndex}]['0']`)
            .addClass('form-control form-control-sm col me-1')
            .attr('placeholder', 'Количество баллов за ответ');

        const deleteInputButton = $('<button><i class="bi bi-x-lg"></i></button><br>')
            .attr('type', 'button')
            .addClass('btn btn-danger btn-sm deleteBtn');

        questionInputContainer
            .append(questionInput)
            .append(answerInput)
            .append(pointsInput)
            .append(deleteInputButton);
        roundContainer.append(questionInputContainer);
    });

    // Удаление вопроса
    $('#rounds-container').on('click', '.deleteBtn', function () {
        const questionContainer = $(this).closest('.question');

        questionContainer.remove();
    });

    $('#next-step').click(function () {
        // Количество раундов
        const roundsQuantity = $('#rounds_quantity').val();

        // Получаем предыдущее количество раундов
        const previousRoundsQuantity = $('#rounds-container .round').length;

        // Определяем разницу в количестве раундов
        const roundsDifference = roundsQuantity - previousRoundsQuantity;

        // Оставляем все без изменений, если количество не поменялось
        if (roundsDifference === 0) {
            return;
        }

        // Удаляем лишние раунды с конца списка, если количество раундов стало меньше чем было
        if (previousRoundsQuantity > roundsQuantity) {
            $('#rounds-container .round:gt(' + (roundsQuantity - 1) + ')').remove();
            return;
        }

        //если количество раундов стало больше чем было, то добавляем новые
        if (previousRoundsQuantity !== 0 && previousRoundsQuantity < roundsQuantity) {
            for (let i = previousRoundsQuantity + 1; i <= previousRoundsQuantity + roundsDifference; i++) {
                const roundContainer = $('<div>').addClass('round mb-3');
                const questionInputContainer = $('<div>').addClass('question mb-1 mt-2 d-flex align-items-center');

                // Round
                const roundInput = $('<input>')
                    .attr('type', 'text')
                    .attr('name', `rounds[${i}]`)
                    .addClass('form-control mb-2')
                    .attr('placeholder', 'Введите название раунда')
                    .attr('required', true);
                const roundLabel = $('<label>')
                    .text('Раунд № ' + i);
                const addInputButton = $('<button><i class="bi bi-plus-lg"></i>Добавить вопрос</button><br>')
                    .attr('type', 'button')
                    .addClass('btn btn-primary btn-sm mb-1 addQuestion');

                // Question
                const questionInput = $('<input>')
                    .attr('type', 'text')
                    .attr('name', `questions[${i}]['0']`)
                    .addClass('form-control form-control-sm col me-1')
                    .attr('placeholder', 'Введите вопрос')
                    .attr('required', true);

                const answerInput = $('<select>')
                    .attr('name', `answer_ids[${i}]['0']`)
                    .addClass('form-select form-select-sm col me-1')
                    .attr('placeholder', 'Выберите ответ')
                    .attr('required', true);
                // Добавление пустого варианта
                answerInput.append($('<option>').attr('value', '').text('Выберите ответ'));
                answers.forEach(function (answer) {
                    answerInput.append($('<option>').attr('value', answer.id).text(answer.answer_title));
                });

                const pointsInput = $('<input>')
                    .attr('type', 'number')
                    .attr('name', `points[${i}]['0']`)
                    .addClass('form-control form-control-sm col me-1')
                    .attr('placeholder', 'Количество баллов за ответ')
                    .attr('required', true);

                const deleteInputButton = $('<button><i class="bi bi-x-lg"></i></button><br>')
                    .attr('type', 'button')
                    .addClass('btn btn-danger btn-sm deleteBtn');

                questionInputContainer
                    .append(questionInput)
                    .append(answerInput)
                    .append(pointsInput)
                    .append(deleteInputButton);
                roundContainer
                    .append(roundLabel)
                    .append(roundInput)
                    .append(addInputButton)
                    .append(questionInputContainer);

                $('#rounds-container').append(roundContainer);

                return;
            }
        }
    })
});
