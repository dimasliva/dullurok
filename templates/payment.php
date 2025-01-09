<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Уроки по HTML, CSS и JavaScript. Научитесь создавать веб-страницы и разрабатывать интерфейсы.">
    <meta name="keywords" content="HTML, CSS, JavaScript, уроки, веб-разработка, <?= LOGO_NAME ?>">
    <link rel="canonical" href="<?= URL_SITE ?>" />
    <link rel="stylesheet" href="<?= STYLES_PATH ?>/global.css" />
    <link rel="stylesheet" href="<?= STYLES_PATH ?>/tailwind.css">

    <!-- Подключение стилей и скриптов flatpickr -->
    <link rel="stylesheet" href="<?= JS_PATH ?>/flatpickr/flatpickr.css">
    <script src="<?= JS_PATH ?>/flatpickr/flatpickr.js"></script>

    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <title><?= PAYMENT_PAGE['name'] ?></title>
    <style>
        #loader svg {
            width: 50px;
            height: 50px;
        }

        .cross_svg svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>

    <div class="flex flex-col items-center space-y-4">
        <h1 class="text-3xl font-bold text-center">
            <?php
            // Выводим соответствующий iframe в зависимости от значения $price
            if ($price == 400) {
                echo 'Курс "Ознакомление"';
            } elseif ($price == 4000) {
                echo 'Мини-Курс';
            } elseif ($price == 1200) {
                echo 'Мега-Курс';
            } else {
                echo '<p class="text-red-500">Ошибка: Неподдерживаемая цена.</p>';
            }
            ?>
        </h1>
        <p class="text-lg text-center">После оплаты вы получите:</p>

        <ul role="list" class="mb-8 space-y-4 text-left mb-2">
            <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                <?php include(SVGS_PATH . '/success.svg') ?>
                <span>Отображение занятий в ЛК</span>
            </li>
            <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                <?php include(SVGS_PATH . '/success.svg') ?>
                <span>
                    <?php
                    if ($price == 400) {
                        echo '1 занятие';
                    } elseif ($price == 4000) {
                        echo '10 дней занятий';
                    } elseif ($price == 1200) {
                        echo '30 дней занятий';
                    } else {
                        echo '';
                    }
                    ?>
                </span>
            </li>
            <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                <?php include(SVGS_PATH . '/success.svg') ?>
                <span>Запись занятия</span>
            </li>
            <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                <?php include(SVGS_PATH . '/success.svg') ?>
                <span>Архив с написанным кодом</span>
            </li>
            <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                <span class="cross_svg">
                    <?php
                    if ($price == 400) {
                        include(SVGS_PATH . '/cross.svg');
                    } elseif ($price == 4000 || $price == 1200) {
                        include(SVGS_PATH . '/success.svg');
                    } else {
                        include(SVGS_PATH . '/cross.svg');
                    }
                    ?>
                </span>
                <span>Домашнее задание</span>
            </li>
            <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                <span class="cross_svg">
                    <?php
                    if ($price == 400) {
                        include(SVGS_PATH . '/cross.svg');
                    } elseif ($price == 4000 || $price == 1200) {
                        include(SVGS_PATH . '/success.svg');
                    } else {
                        include(SVGS_PATH . '/cross.svg');
                    }
                    ?>
                </span>
                <span>Тех.поддержка после занятия</span>
            </li>
        </ul>

        <form id="paymentForm" method="POST" action="" class="flex flex-col items-center">
            <input type="text" id="dateTimePicker" name="dates[]" class="bg-gray-800 border border-gray-600 rounded p-2"
                placeholder="Выберите дату и время" />

            <div id="paymentSection" class="hidden">
                <?php
                // Выводим соответствующий iframe в зависимости от значения $price
                if ($price == 400) {
                    echo '<a href="https://yoomoney.ru/transfer/quickpay?requestId=353534353232393839395f31313861383938333431346135663063643930323735303130343962346438663639663935613431" target="_blank" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Перевести: 400 рублей</a>';
                } elseif ($price == 4000) {
                    echo '<a href="https://yoomoney.ru/transfer/quickpay?requestId=353534353232393333345f65316638333064613738333038646538653635363538323539383761316232626137336263393536" target="_blank" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Перевести: 4000 рублей</a>';
                } elseif ($price == 1200) {
                    echo '<a href="https://yoomoney.ru/transfer/quickpay?requestId=353534353232383534305f39386636353537393432386137316566316334383634643533626633366264303365396465643035" target="_blank" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Перевести: 12000 рублей</a>';
                } else {
                    echo '<p class="text-red-500">Ошибка: Неподдерживаемая цена.</p>';
                }
                ?>
            </div>

            <button type="button" id="checkPaymentButton"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded hidden mt-2">Проверить
                платёж</button>

            <div id="loader" class="hidden mt-4">
                <span class="animate-spin ">
                    <?php include(SVGS_PATH . '/loader.svg') ?>
                </span>
            </div>

            <div id="successMessage" class="hidden flex flex-col items-center space-y-2">
                <p class="text-lg">Оплата прошла успешно</p>
                <button type="submit" id="goToAccountButton"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Перейти в личный
                    кабинет</button>
            </div>

            <div id="errorMessage" class="hidden text-red-500 mt-2">
                <p>Платёж не прошел. Подождите минуту и нажмите повторно.</p>
            </div>
        </form>

    </div>

    <script>
        // Переменная для отслеживания времени на странице
        let timeOnPage = 0;
        const timeLimit = 60000; // 1 минута в миллисекундах
        const interval = setInterval(() => {
            timeOnPage += 1000; // Увеличиваем время на 1 секунду
        }, 1000);

        // Инициализация Flatpickr и сохранение экземпляра
        const datePicker = flatpickr("#dateTimePicker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today", // Минимальная дата - сегодня
            mode: "multiple", // Режим выбора нескольких дат
            locale: {
                firstDayOfWeek: 1 // Пн как первый день недели
            },
            onClose: function (selectedDates) {
                let days;
                <?php
                if ($price == 400) {
                    echo 'days = 1;';
                } elseif ($price == 4000) {
                    echo 'days = 10;';
                } elseif ($price == 12000) {
                    echo 'days = 30;';
                } else {
                    echo 'days = 0;'; // Или любое значение по умолчанию
                }
                ?>
                const checkPaymentButton = document.getElementById('checkPaymentButton');
                const paymentSection = document.getElementById('paymentSection');

                // Проверяем количество выбранных дат
                if (selectedDates.length > days) {
                    alert(`Вы не можете выбрать более ${days} дней.`);
                    checkPaymentButton.classList.add('hidden');
                    paymentSection.classList.add('hidden');
                } else if (selectedDates.length < days) {
                    alert(`Вы можете выбрать менее ${days} дней.`);
                    checkPaymentButton.classList.add('hidden');
                    paymentSection.classList.add('hidden');
                } else if (selectedDates.length === days) {
                    checkPaymentButton.classList.remove('hidden');
                    paymentSection.classList.remove('hidden');
                }

                // Сохраняем выбранные даты в скрытых полях формы
                const paymentForm = document.getElementById('paymentForm');
                paymentForm.querySelectorAll('input[name="dates[]"]').forEach(input => input.remove()); // Удаляем старые значения
                selectedDates.forEach(date => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'dates[]';
                    hiddenInput.value = date.toISOString(); // Сохраняем полное значение даты и времени
                    paymentForm.appendChild(hiddenInput);
                });
            }
        });

        document.getElementById('checkPaymentButton').addEventListener('click', function () {
            const loader = document.getElementById('loader');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            loader.classList.remove('hidden');
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            // Проверяем, сколько времени пользователь провел на странице
            setTimeout(() => {
                loader.classList.add('hidden'); // Скрываем загрузчик
                if (timeOnPage < timeLimit) {
                    // Если время на странице меньше 1 минуты
                    errorMessage.classList.remove('hidden');
                } else {
                    // Если время на странице больше или равно 1 минуте
                    successMessage.classList.remove('hidden');
                }
            }, 1000); // Ждем 1 секунду перед выводом сообщения
        });
    </script>

</body>

</html>