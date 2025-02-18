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
    <title><?= CABINET_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>


    <div class="flex">
        <div class="container mx-auto p-8 flex-1">
            <h1 class="text-2xl font-bold mb-6">Мои занятия</h1>

            <div class="grid grid-cols-4 gap-6">
                <div class="col-span-3">
                    <h2 class="text-xl font-semibold mb-4">Пройденные занятия</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Карточка занятия -->
                        <?php if (isset($lessons)): ?>
                            <?php foreach ($lessons as $lesson): ?>
                                <div class="bg-gray-800 shadow-md rounded-lg p-4">
                                    <h3 class="font-bold text-lg"><?= "Занятие " . $lesson->getId() ?> </h3>
                                    <p class="text-gray-400">Дата: <?= $lesson->getCreatedAt() ?></p>
                                    <a href="<?= LESSON_VIDEO_PAGE['url'] . '/' . $lesson->getId() ?>"
                                        class="text-blue-400 hover:underline">Смотреть урок</a>
                                    <div class="mt-2 flex items-center cursor-pointer">
                                        <a class="text-gray-400 hover:underline" href="<?= $lesson->getFile() ?>">Скачать
                                            код</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Календарь занятий -->
                <div class="mb-8 mt-4">
                    <h2 class="text-xl font-semibold mb-4">Календарь занятий</h2>
                    <?php require_once("templates/components/calendar/calendar.php") ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>