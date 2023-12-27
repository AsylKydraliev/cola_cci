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

    let questionIndex = 0;

    $('.addQuestion').click(function () {
        // Добавление вопроса
        const roundContainer = $(this).closest('.round');
        const questionInputContainer = $('<div>').addClass('question mb-1 mt-2 d-flex align-items-center');
        const roundName = roundContainer.find('input[name^="rounds["]').attr('name');
        const roundId = roundName.match(/\[(\d+)\]/)[1];

        const questionInput = $('<input>')
            .attr('type', 'text')
            .attr('name', `new_questions[${roundId}][${questionIndex}]`)
            .addClass('form-control form-control-sm col me-1')
            .attr('placeholder', 'Введите вопрос')
            .attr('required', true);
        const answerInput = $('<select>')
            .attr('name', `new_answer_ids[${roundId}][${questionIndex}]`)
            .addClass('form-select form-select-sm col me-1')
            .attr('placeholder', 'Выберите ответ')
            .attr('required', true);
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
            .attr('name', `new_points[${roundId}][${questionIndex}]`)
            .addClass('form-control form-control-sm col me-1')
            .attr('placeholder', 'Количество баллов за ответ');

        const deleteInputButton = $('<button><i class="bi bi-x-lg"></i></button><br>')
            .attr('type', 'button')
            .addClass('btn btn-danger btn-sm deleteBtn');

        const questionsLength = roundContainer.find('.question').length + 1;
        const QUESTIONS_COUNT = 10;
        const isRoundQuestionsCountValid = questionsLength >= QUESTIONS_COUNT;

        $(this).prop('disabled', isRoundQuestionsCountValid);

        questionInputContainer
            .append(questionInput)
            .append(answerInput)
            .append(pointsInput)
            .append(deleteInputButton);

        roundContainer.append(questionInputContainer);

        questionIndex++;
    });

    // Удаление вопроса
    $('#rounds-container').on('click', '.deleteBtn', function () {
        const questionContainer = $(this).closest('.question');
        const roundContainer = $(this).closest('.round');

        roundContainer.find('.addQuestion').prop('disabled', false);
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

        let newQuestionIndex = 0;
        //если количество раундов стало больше чем было, то добавляем новые
        if (previousRoundsQuantity !== 0 && previousRoundsQuantity < roundsQuantity) {
            for (let i = previousRoundsQuantity + 1; i <= previousRoundsQuantity + roundsDifference; i++) {
                const roundContainer = $('<div>').addClass('round mb-3');
                const questionInputContainer = $('<div>').addClass('question mb-1 mt-2 d-flex align-items-center');

                // Round
                const roundInput = $('<input>')
                    .attr('type', 'text')
                    .attr('name', `new_rounds[${i}]`)
                    .addClass('form-control mb-2')
                    .attr('placeholder', 'Введите название раунда')
                    .attr('required', true);
                const roundLabel = $('<label>')
                    .text('Раунд № ' + i);
                const roundInputDescription = $('<input>')
                    .attr('type', 'text')
                    .attr('name', `new_round_descriptions[${i}]`)
                    .addClass('form-control mb-2')
                    .attr('placeholder', 'Введите описание раунда')
                    .attr('required', true);
                const addInputButton = $('<button><i class="bi bi-plus-lg"></i>Добавить вопрос</button><br>')
                    .attr('type', 'button')
                    .addClass('btn btn-primary btn-sm mb-1 addQuestion');

                // Question
                const questionInput = $('<input>')
                    .attr('type', 'text')
                    .attr('name', `new_questions[${i}][${newQuestionIndex}]`)
                    .addClass('form-control form-control-sm col me-1')
                    .attr('placeholder', 'Введите вопрос')
                    .attr('required', true);

                const answerInput = $('<select>')
                    .attr('name', `new_answer_ids[${i}][${newQuestionIndex}]`)
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
                    .attr('name', `new_points[${i}][${newQuestionIndex}]`)
                    .addClass('form-control form-control-sm col me-1')
                    .attr('placeholder', 'Количество баллов за ответ')
                    .attr('required', true);

                const deleteInputButton = $('<button><i class="bi bi-x-lg"></i></button><br>')
                    .attr('type', 'button')
                    .addClass('btn btn-danger btn-sm deleteBtn');

                const questionsLength = roundContainer.find('.question').length + 1;
                const QUESTIONS_COUNT = 10;
                const isRoundQuestionsCountValid = questionsLength >= QUESTIONS_COUNT;

                $(this).prop('disabled', isRoundQuestionsCountValid);

                questionInputContainer
                    .append(questionInput)
                    .append(answerInput)
                    .append(pointsInput)
                    .append(deleteInputButton);
                roundContainer
                    .append(roundLabel)
                    .append(roundInput)
                    .append(roundInputDescription)
                    .append(addInputButton)
                    .append(questionInputContainer);

                $('#rounds-container').append(roundContainer);
            }

            let additionalQuestionIndex = 1;
            $('.addQuestion').click(function () {
                // Добавление вопроса
                const roundContainer = $(this).closest('.round');
                const questionInputContainer = $('<div>').addClass('question mb-1 mt-2 d-flex align-items-center');
                const roundName = roundContainer.find('input[name^="new_rounds["]').attr('name');
                const roundIndex = roundName.match(/\[(\d+)\]/)[1];

                const questionInput = $('<input>')
                    .attr('type', 'text')
                    .attr('name', `new_questions[${roundIndex}][${additionalQuestionIndex}]`)
                    .addClass('form-control form-control-sm col me-1')
                    .attr('placeholder', 'Введите вопрос')
                    .attr('required', true);
                const answerInput = $('<select>')
                    .attr('name', `new_answer_ids[${roundIndex}][${additionalQuestionIndex}]`)
                    .addClass('form-select form-select-sm col me-1')
                    .attr('placeholder', 'Выберите ответ')
                    .attr('required', true);
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
                    .attr('name', `new_points[${roundIndex}][${additionalQuestionIndex}]`)
                    .addClass('form-control form-control-sm col me-1')
                    .attr('placeholder', 'Количество баллов за ответ');

                const deleteInputButton = $('<button><i class="bi bi-x-lg"></i></button><br>')
                    .attr('type', 'button')
                    .addClass('btn btn-danger btn-sm deleteBtn');

                const questionsLength = roundContainer.find('.question').length + 1;
                const QUESTIONS_COUNT = 10;
                const isRoundQuestionsCountValid = questionsLength >= QUESTIONS_COUNT;

                $(this).prop('disabled', isRoundQuestionsCountValid);

                questionInputContainer
                    .append(questionInput)
                    .append(answerInput)
                    .append(pointsInput)
                    .append(deleteInputButton);

                roundContainer.append(questionInputContainer);
                additionalQuestionIndex++;
            });
        }
    })
});
