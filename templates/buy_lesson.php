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
    <title><?= BUY_LESSON_PAGE['name'] ?></title>
    <style>
        .cross_svg svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>

    <div class="flex">
        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
            <!-- Курс по HTML -->
            <div
                class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-gray-800 border border-gray-600 rounded-lg shadow dark:border-gray-700 xl:p-8 dark:bg-gray-900 dark:text-white">
                <div class="flex-grow">
                    <h3 class="mb-4 text-white dark:text-white text-2xl font-semibold">Ознакомление</h3>
                    <p class="font-light text-gray-300 sm:text-lg dark:text-gray-400">Подойдёт для изучения маленькой
                        темы,
                        с
                        которой возникли трудности</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold text-white">1 Занятие</span>
                    </div>
                    <!-- Список -->
                    <ul role="list" class="mb-8 space-y-4 text-left">

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
                                <?php include(SVGS_PATH . '/cross.svg') ?>
                            </span>

                            <span>Домашнее задание</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <span class="cross_svg">
                                <?php include(SVGS_PATH . '/cross.svg') ?>
                            </span>

                            <span>Тех.поддержка после занятия</span>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <a class="w-full" href="<?= CHECKOUT_PAGE['url'] ?>?price=400">
                        <button
                            class="w-full font-bold text-lg px-6 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                            Оплатить 400₽
                        </button>
                    </a>
                </div>
            </div>

            <!-- Курс по CSS -->
            <div
                class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-gray-800 border border-gray-600 rounded-lg shadow dark:border-gray-700 xl:p-8 dark:bg-gray-900 dark:text-white">
                <div class="flex-grow">
                    <h3 class="mb-4 text-2xl text-white dark:text-white font-semibold">Мини-Курс</h3>
                    <p class="font-light text-gray-300 sm:text-lg dark:text-gray-400">Детально разберём язык
                        программирования, по
                        пунктам </p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold text-white">10 занятий</span>
                    </div>
                    <ul role="list" class="mb-8 space-y-4 text-left">

                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Запись занятия</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Архив с написанным кодом</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>


                            <span>Домашнее задание</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>


                            <span>Тех.поддержка после занятия</span>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <a class="w-full" href="<?= CHECKOUT_PAGE['url'] ?>?price=4000">
                        <button
                            class="w-full font-bold text-lg px-6 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                            Оплатить 4000₽
                        </button>
                    </a>
                </div>
            </div>

            <!-- Курс по JavaScript -->
            <div
                class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-gray-800 border border-gray-600 rounded-lg shadow dark:border-gray-700 xl:p-8 dark:bg-gray-900 dark:text-white">
                <div class="flex-grow">
                    <h3 class="mb-4 text-white dark:text-white text-2xl font-semibold">Mega-Курс</h3>
                    <p class="font-light text-gray-300 sm:text-lg dark:text-gray-400">Полноценно пройдёмся по всему
                        материалу, до полного его понимания</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold text-white">30 Занятий</span>
                    </div>
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Запись занятия</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Архив с написанным кодом</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>


                            <span>Домашнее задание</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>


                            <span>Тех.поддержка после занятия</span>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <a class="w-full" href="<?= CHECKOUT_PAGE['url'] ?>?price=12000">
                        <button
                            class="w-full font-bold text-lg px-6 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                            Оплатить 12000₽
                        </button>
                    </a>
                </div>
            </div>

        </div>



    </div>
</body>

</html>