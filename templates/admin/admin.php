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
    <title><?= ADMIN_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-10">
        <a href="<?= ADMIN_EVENTS_PAGE['url'] ?>"
            class="bg-gray-800 p-4 rounded shadow hover:shadow-lg transition duration-300">
            <h2 class="text-lg font-bold mb-2"><?= ADMIN_EVENTS_PAGE['name'] ?></h2>
        </a>
        <a href="<?= ADMIN_LESSON_PAGE['url'] ?>"
            class="bg-gray-800 p-4 rounded shadow hover:shadow-lg transition duration-300">
            <h2 class="text-lg font-bold mb-2"><?= ADMIN_LESSON_PAGE['name'] ?></h2>
        </a>

    </div>
</body>

</html>