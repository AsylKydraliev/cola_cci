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

            // Визуальное подтверждение
            alert("Ссылка скопирована в буфер обмена: " + $(inputId).val());
        });
    });
});
