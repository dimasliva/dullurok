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
            <h1 class="text-2xl font-bold mb-6">Кабинет пользователя</h1>

            <div class="grid grid-cols-4 gap-6">
                <div class="col-span-1">
                    <!-- Карточка пользователя -->
                    <div class="bg-gray-800 shadow-md rounded-lg p-4">
                        <h2 class="text-xl font-semibold mb-4">Профиль</h2>
                        <div class="flex flex-col gap-4">
                            <p class="text-gray-400"><strong>Логин:</strong> <?= $user->getUsername() ?></p>
                            <p class="text-gray-400"><strong>Курс:</strong> <?= $course->getCourseName() ?></p>
                            <p class="text-gray-400"><strong>Начало обучения:</strong> <?= $user->getCreatedAt() ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>