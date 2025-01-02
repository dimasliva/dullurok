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
    <title><?= LESSON_VIDEO_PAGE['name'] ?></title>
    <style>
        .fullscreen-container {
            width: 70%;
            /* Задаем ширину 50% */
            max-width: 1200px;
            /* Максимальная ширина для больших экранов */
            margin: 0 auto;
            /* Центрируем контейнер */
        }

        .responsive-iframe {
            width: 100%;
            /* Ширина iframe 100% от родительского контейнера */
            height: 0;
            padding-bottom: 56.25%;
            /* Соотношение сторон 16:9 (56.25% = 9/16 * 100) */
            position: relative;
            display: block;
        }

        .responsive-iframe>iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            /* Убираем рамку */
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>
    <div class="flex justify-center items-center mt-4">
        <div class="fullscreen-container">
            <div class="responsive-iframe">
                <iframe src="<?= $lesson->getVideo() ?>" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</body>

</html>