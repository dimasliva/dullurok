<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Уроки по HTML, CSS и JavaScript. Научитесь создавать веб-страницы и разрабатывать интерфейсы.">
    <meta name="keywords" content="HTML, CSS, JavaScript, уроки, веб-разработка, <?= LOGO_NAME ?>">
    <link rel="canonical" href="<?= URL_SITE ?>" />
    <link rel="stylesheet" href="<?= STYLES_PATH ?>/global.css" />
    <link rel="stylesheet" href="<?= STYLES_PATH ?>/tailwind.css">
    <title>Главная</title>
</head>

<body>
    <?php require_once("templates/components/header/header.php") ?>
    <section class="bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl text-white">
                    Бесплатные <br> уроки
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl">
                    Здесь вы найдёте занятия по <a href="/tutorials" class="hover:underline text-blue-500">HTML, CSS и
                        JavaScript</a>. Вы
                    получите все необходимые знания для создания современных веб-приложений и сайтов.
                    Уроки на все нужные темы: от разбора документации, до создания современного и быстрого сайта
                </p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <a href="/tutorials"
                        class="inline-flex items-center justify-center w-full px-5 py-3 text-sm font-medium text-center text-white border border-gray-700 rounded-lg sm:w-auto hover:bg-gray-700 focus:ring-4 focus:ring-gray-800">
                        <span class="mr-2">
                            <?php include(SVGS_PATH . '/terminal.svg') ?>
                        </span>
                        Перейти к занятиям
                    </a>
                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="<?= IMGS_PATH ?>/hero.png" alt="hero image">

            </div>
        </div>
    </section>

    <section class="bg-gray-900 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">
            <!-- Row -->
            <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                <div class="text-gray-300 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-white dark:text-white">Занятия в удобное
                        время</h2>
                    <p class="mb-8 font-light lg:text-xl">Наши занятия по обучению создания сайтов предлагают уникальную
                        возможность изучать веб-разработку в удобное для вас время. Мы понимаем, что график каждого
                        человека
                        индивидуален, поэтому наши курсы адаптированы под ваши потребности.</p>
                    <!-- List -->
                    <ul role="list" class="pt-8 space-y-5 border-t border-gray-700 my-7 dark:border-gray-600">
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Постепенное
                                изучение каждой темы</span>
                        </li>
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Постоянная
                                практика</span>
                        </li>
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Создание
                                собственного сайта</span>
                        </li>
                    </ul>
                    <p class="mb-8 font-light lg:text-xl">Мы не только изучаем возможности языка, но и воплощаем их в
                        реальных элементах, создавая впечатляющие сайты.</p>
                </div>
                <img class="hidden w-full mb-4 rounded-lg lg:mb-0 lg:flex" src="<?= IMGS_PATH ?>/feature-1.png"
                    alt="dashboard feature image">
            </div>
            <!-- Row -->
            <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                <img class="hidden w-full mb-4 rounded-lg lg:mb-0 lg:flex" src="<?= IMGS_PATH ?>/feature-2.png"
                    alt="feature image 2">
                <div class="text-gray-300 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-white dark:text-white">Быстрое создание
                        сайтов</h2>
                    <p class="mb-8 font-light lg:text-xl">Стремительно овладейте искусством создания современных
                        веб-пространств, используя передовые инструменты и технологии. Наши бесплатные курсы по
                        веб-разработке содержат все ключевые навыки, необходимые для быстрого создания функциональных и
                        привлекательных веб-страниц.
                    </p>
                    <!-- List -->
                    <ul role="list" class="pt-8 space-y-5 border-t border-gray-700 my-7 dark:border-gray-600">
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Использование
                                фреймворков</span>
                        </li>
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Современный
                                дизайн</span>
                        </li>
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Современные
                                методы
                                разработки</span>
                        </li>
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Использование
                                библиотек</span>
                        </li>
                        <li class="flex space-x-3">
                            <?php include(SVGS_PATH . '/purple_cirle.svg') ?>
                            <span class="text-base font-medium leading-tight text-white dark:text-white">Быстрое
                                обучение</span>
                        </li>
                    </ul>
                    <p class="font-light lg:text-xl">Хотите создать уникальный и эффективный сайт, который будет
                        выделяться
                        среди остальных? Тогда выделите немного своего драгоценного свободного времени, чтобы вложить в
                        его
                        развитие. </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-900 dark:bg-gray-800">
        <div
            class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-4 lg:gap-16 xl:gap-24 lg:py-24 lg:px-6">
            <div class="col-span-2 mb-8">
                <p class="text-lg font-medium text-purple-500 dark:text-purple-400">Погрузитесь в веб-разработку</p>
                <h2 class="mt-3 mb-4 text-3xl font-extrabold tracking-tight text-white md:text-3xl dark:text-gray-100">
                    Освойте HTML, CSS и JavaScript с нашими курсами </h2>
                <p class="font-light text-gray-400 sm:text-xl dark:text-gray-300">Наши интерактивные курсы помогут вам
                    стать
                    экспертом в веб-разработке. Учитесь в удобном для вас темпе и получайте поддержку опытных
                    преподавателей.</p>
                <div class="pt-6 mt-6 space-y-4 border-t border-gray-700 dark:border-gray-600">
                    <div> <a href="/tutorials"
                            class="inline-flex items-center text-base font-medium text-purple-500 hover:text-purple-400 dark:text-purple-400 dark:hover:text-purple-300">
                            Начать обучение <?php include(SVGS_PATH . '/purple_arrow.svg') ?> </a> </div>
                    <div> <a href="/tutorials"
                            class="inline-flex items-center text-base font-medium text-purple-500 hover:text-purple-400 dark:text-purple-400 dark:hover:text-purple-300">
                            Ознакомиться с курсами <?php include(SVGS_PATH . '/purple_arrow.svg') ?> </a>
                    </div>
                </div>
            </div>
            <div class="col-span-2 space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0">
                <div> <?php include(SVGS_PATH . '/service.svg') ?>
                    <h3 class="mb-2 text-2xl font-bold dark:text-gray-100">24/7 поддержка</h3>
                    <p class="font-light text-gray-400 dark:text-gray-300">Наши специалисты всегда готовы помочь вам</p>
                </div>
                <div> <?php include(SVGS_PATH . '/two_users.svg') ?>
                    <h3 class="mb-2 text-2xl font-bold dark:text-gray-100">100,000+ учеников</h3>
                    <p class="font-light text-gray-400 dark:text-gray-300">Наши курсы уже прошли тысячи студентов</p>
                </div>
                <div> <?php include(SVGS_PATH . '/world.svg') ?>
                    <h3 class="mb-2 text-2xl font-bold dark:text-gray-100">Гибкие форматы</h3>
                    <p class="font-light text-gray-400 dark:text-gray-300">Учитесь онлайн, офлайн или в смешанном
                        формате
                    </p>
                </div>
                <div> <?php include(SVGS_PATH . '/market.svg') ?>
                    <h3 class="mb-2 text-2xl font-bold dark:text-gray-100">Бесплатно</h3>
                    <p class="font-light text-gray-400 dark:text-gray-300">Все уроки и курсы абсолютно бесплатные</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-800 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-24 lg:px-6">
            <figure class="max-w-screen-md mx-auto">
                <?php include(SVGS_PATH . '/quotes.svg') ?>
                <blockquote>
                    <p class="text-xl font-medium text-white md:text-2xl dark:text-white">"Этот сайт помог мне стать
                        Senior
                        frontend разработчиком. На нем я нашел огромное количество готовых компонентов и страниц,
                        начиная от
                        экрана входа и заканчивая сложными панелями управления. Это идеальный вариант для моего
                        следующего
                        SaaS-приложения."</p>
                </blockquote>
                <figcaption class="flex items-center justify-center mt-6 space-x-3">
                    <img class="w-6 h-6 rounded-full" src="<?= IMGS_PATH ?>/michael-gouch.png" alt="profile picture">
                    <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                        <div class="pr-3 font-medium text-white dark:text-white">Рома Беляев</div>
                        <div class="pl-3 text-sm font-light text-gray-300 dark:text-gray-400">Фрилансер</div>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>

    <section class="bg-gray-900 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-24 lg:px-6">
            <div class="max-w-screen-md mx-auto mb-8 text-center lg:mb-12">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-white dark:text-white">Курсы по
                    веб-разработке
                </h2>
                <p class="mb-5 font-light text-gray-300 sm:text-xl dark:text-gray-400">Наши курсы помогут вам освоить
                    ключевые технологии веб-разработки и открыть новые возможности для карьеры.</p>
            </div>
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                <!-- Курс по HTML -->
                <div
                    class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-gray-800 border border-gray-600 rounded-lg shadow dark:border-gray-700 xl:p-8 dark:bg-gray-900 dark:text-white">
                    <h3 class="mb-4 text-white dark:text-white text-2xl font-semibold">Курс по HTML</h3>
                    <p class="font-light text-gray-300 sm:text-lg dark:text-gray-400">Идеально подходит для начинающих,
                        желающих освоить основы веб-разработки.</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold text-white">Бесплатно</span>
                    </div>
                    <!-- Список -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Основы HTML и структуры документа</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Создание семантической разметки</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Практические задания и проекты</span>
                        </li>
                    </ul>
                    <a href="/tutorials"
                        class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-purple-900">Записаться
                        на курс</a>
                </div>
                <!-- Курс по CSS -->
                <div
                    class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-gray-800 border border-gray-600 rounded-lg shadow dark:border-gray-700 xl:p-8 dark:bg-gray-900 dark:text-white">
                    <h3 class="mb-4 text-2xl text-white dark:text-white font-semibold">Курс по CSS</h3>
                    <p class="font-light text-gray-300 sm:text-lg dark:text-gray-400">Углубленное изучение стилей и
                        дизайна
                        веб-страниц с пользованием: css, scss, tailwindcss.</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold text-white">Бесплатно</span>
                    </div>
                    <!-- Список -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Селекторы, свойства и значения</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Адаптивный и отзывчивый дизайн</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Создание анимаций и эффектов</span>
                        </li>
                    </ul>
                    <a href="/tutorials"
                        class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-purple-900">Записаться
                        на курс</a>
                </div>
                <!-- Курс по JavaScript -->
                <div
                    class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-gray-800 border border-gray-600 rounded-lg shadow dark:border-gray-700 xl:p-8 dark:bg-gray-900 dark:text-white">
                    <h3 class="mb-4 text-white dark:text-white text-2xl font-semibold">Курс по JavaScript</h3>
                    <p class="font-light text-gray-300 sm:text-lg dark:text-gray-400">Изучите основы программирования и
                        интерактивное взаимодействия с веб-страницами.</p>
                    <div class="flex items-baseline justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold text-white">Бесплатно</span>
                    </div>
                    <!-- Список -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Основы синтаксиса и структуры языка</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Работа с DOM и событиями</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300 dark:text-gray-400">
                            <?php include(SVGS_PATH . '/success.svg') ?>
                            <span>Создание интерактивных веб-приложений</span>
                        </li>
                    </ul>
                    <a href="/tutorials"
                        class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-purple-900">Записаться
                        на курс</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-900 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-24 lg:px-6">
            <h2
                class="mb-6 text-3xl font-extrabold tracking-tight text-center text-white lg:mb-8 lg:text-3xl dark:text-white">
                Часто задаваемые вопросы</h2>
            <div class="max-w-screen-md mx-auto">
                <div id="accordion-flush" data-accordion="collapse"
                    data-active-classes="bg-gray-900 dark:bg-gray-900 text-white dark:text-white"
                    data-inactive-classes="text-gray-300 dark:text-gray-400">

                    <h3 id="accordion-flush-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-white bg-gray-900 border-b border-gray-700 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                            data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                            aria-controls="accordion-flush-body-1">
                            <span>Можно ли использовать бесплатные курсы по HTML, CSS и JavaScript в своих
                                проектах?</span>
                            <?php include(SVGS_PATH . '/bottom_arrow.svg') ?>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-1" class="" aria-labelledby="accordion-flush-heading-1">
                        <div class="py-5 border-b border-gray-700 dark:border-gray-600">
                            <p class="mb-2 text-gray-300 dark:text-gray-400">Да, вы можете использовать материалы курсов
                                в
                                своих проектах. Они предназначены для обучения и могут быть применены в личных и
                                коммерческих целях.</p>

                        </div>
                    </div>

                    <h3 id="accordion-flush-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-300 border-b border-gray-700 dark:border-gray-600 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                            aria-controls="accordion-flush-body-2">
                            <span>Почему курсы бесплатные?</span>
                            <?php include(SVGS_PATH . '/bottom_arrow.svg') ?>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                        <div class="py-5 border-b border-gray-700 dark:border-gray-600">
                            <p class="mb-2 text-gray-300 dark:text-gray-400">Мы верим, что образование должно быть
                                доступным
                                для всех. Бесплатные курсы позволяют людям изучать новые навыки и развиваться,
                                независимо от
                                их финансового положения.</p>
                            <p class="text-gray-300 dark:text-gray-400">Кроме того, бесплатные курсы помогают нам
                                создать
                                сообщество обучающихся, что в свою очередь способствует обмену знаниями и опытом.</p>
                        </div>
                    </div>

                    <h3 id="accordion-flush-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-300 border-b border-gray-700 dark:border-gray-600 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                            aria-controls="accordion-flush-body-3">
                            <span>Как зарабатывает сайт, если курсы бесплатные?</span>
                            <?php include(SVGS_PATH . '/bottom_arrow.svg') ?>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                        <div class="py-5 border-b border-gray-700 dark:border-gray-600">
                            <p class="mb-2 text-gray-300 dark:text-gray-400">Сайт зарабатывает на рекламе, партнерских
                                программах и платных курсах, которые предлагают углубленное обучение и дополнительные
                                ресурсы. Это позволяет нам поддерживать бесплатные курсы и улучшать качество контента.
                            </p>
                            <p class="text-gray-300 dark:text-gray-400">Также мы предлагаем бесплатные <a
                                    target="_blank" href="https://rutube.ru/channel/44511402/"
                                    class="text-purple-600 dark:text-purple-500 hover:underline"> видеоуроки</a> и
                                другие
                                услуги, которые помогают пользователям продвигать свои навыки и карьеру.</p>
                        </div>
                    </div>


                    <h3 id="accordion-flush-heading-4">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-300 border-b border-gray-700 dark:border-gray-600 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-4" aria-expanded="false"
                            aria-controls="accordion-flush-body-4">
                            <span>Какой браузер поддерживается для курсов?</span>
                            <?php include(SVGS_PATH . '/bottom_arrow.svg') ?>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-4" class="hidden" aria-labelledby="accordion-flush-heading-4">
                        <div class="py-5 border-b border-gray-700 dark:border-gray-600">
                            <p class="mb-2 text-gray-300 dark:text-gray-400">Курсы поддерживаются во всех современных
                                браузерах, включая Chrome, Firefox, Safari и Edge. Мы рекомендуем всегда обновлять
                                браузер
                                до последней версии для лучшей работы.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('button[data-accordion-target]').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-accordion-target');
                const targetElement = document.querySelector(targetId);

                // Toggle the visibility of the target element
                targetElement.classList.toggle('hidden');

                // Update the aria-expanded attribute
                const isExpanded = button.getAttribute('aria-expanded') === 'true';
                button.setAttribute('aria-expanded', !isExpanded);
            });
        });
    </script>

    <section class="bg-gray-800 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pt-8 mx-auto lg:pt-16 lg:px-6">
            <div class="max-w-screen-sm mx-auto text-center">
                <h2 class="mb-4 text-3xl font-extrabold leading-tight tracking-tight text-white dark:text-white">
                    Начните бесплатное обучение сегодня
                </h2>
                <p class="mb-6 font-light text-gray-300 dark:text-gray-400 md:text-lg">Попробуйте платформу
                    <?= LOGO_NAME ?> уже сегодня. Для этого не нужно регистрироваться на сайте .
                </p>
                <a href="/tutorials"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">
                    Попробовать
                </a>
            </div>
        </div>
    </section>

    <!-- End block -->

    <footer class="bg-gray-800 dark:bg-gray-900">
        <div class="max-w-screen-xl p-4 py-6 mx-auto lg:py-16 md:p-8 lg:p-10">
            <hr class="my-6 border-gray-600 sm:mx-auto dark:border-gray-700 lg:my-8">
            <div class="text-center">
                <a href="/tutorials"
                    class="flex items-center justify-center mb-5 text-2xl font-semibold text-white dark:text-white">
                    <?= LOGO_NAME ?>
                </a>
                <span class="block text-sm text-center text-gray-400 dark:text-gray-400">© 2024-2025
                    <?= LOGO_NAME ?>™. Все права
                    защищены.
                </span>
            </div>
        </div>
    </footer>

</body>

</html>