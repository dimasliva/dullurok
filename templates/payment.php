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
    <title><?= PAYMENT_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Инструкция по оплате</h1>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Шаги для оплаты</h2>
            <ol class="list-decimal list-inside space-y-2">
                <li>Введите необходимые реквизиты.</li>
                <li>Произведите оплату.</li>
                <li>Подтвердите платеж.</li>
                <li>Скиньте скриншот оплаты в <a href="https://t.me/DmitryErmilov0" target="_blank"
                        class="text-blue-400 hover:text-blue-600 transition-colors">telegram</a>.</li>
                <li>Нажмите <a href="#" target="_blank"
                        class="text-blue-400 hover:text-blue-600 transition-colors">подтвердить</a>.</li>
            </ol>
        </div>


        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Реквизиты для оплаты</h2>
            <p class="mb-2">Пожалуйста, используйте следующие реквизиты для выполнения платежа:</p>
            <ul class="list-disc list-inside space-y-1">
                <li>ФИО Получателя: <strong>Дмитрий Олегович Е.</strong></li>
                <li>Номер телефона: <strong>+79521364530</strong></li>
                <li>Банк: <strong>Альфа-Банк или Сбербанк</strong></li>
            </ul>
        </div>

        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Фото</h2>
            <img src="<?= IMGS_PATH ?>/payment1.png" alt="Описание изображения" class="rounded-lg shadow-md">
            <img src="<?= IMGS_PATH ?>/payment2.png" alt="Описание изображения" class="rounded-lg shadow-md">
        </div>
    </div>
</body>

</html>