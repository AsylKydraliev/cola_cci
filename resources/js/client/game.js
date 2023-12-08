$(document).ready(function () {
    // Получаем вопрос
    const answer = $('#answer').data('answer');

    // Получаем все дочерние элементы с классом "bubbles" в виде массива
    const bubbles = $(".bubbles").children().toArray();

    // Генерируем случайный шарик
    const answerIndex  = Math.floor(Math.random() * bubbles.length);

    // Получаем случайный элемент
    const randomElement = bubbles[answerIndex];

    // Создаем элемент вопрос
    const answerContent = '<span class="answer d-none">' + answer + '</span>';

    $(randomElement).append(answerContent);

    // Находим дочерний элемент с классом "answer" и удаляем класс "d-none"
    $(".bubble").on("click", function () {
        $(this).find('.answer').removeClass('d-none');
    });
});

