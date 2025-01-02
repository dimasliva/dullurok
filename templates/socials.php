<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Социальные сети - Узнайте больше о наших каналах на Rutube, Dzen, Telegram, YouTube и Nuum. Учитесь веб-разработке с нашими уроками и статьями.">
    <meta name="keywords" content="веб-разработка, Rutube, Dzen, Telegram, YouTube, Nuum, HTML, CSS, JavaScript, уроки">
    <meta name="author" content="<?= LOGO_NAME ?>">
    <title>Социальные сети - Веб-разработка</title>
    <link rel="canonical" href="<?= URL_SITE ?>social" />
    <link rel="stylesheet" href="<?= STYLES_PATH ?>/global.css" />
    <link rel="stylesheet" href="<?= STYLES_PATH ?>/tailwind.css">
</head>

<body>
    <?php require_once("templates/components/header/header.php"); ?>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Социальные сети</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-8">
            <?php
            $items = [
                [
                    'url' => 'https://www.youtube.com/@Dull-n2s',
                    'img' => 'youtube_my_channel.png',
                    'name' => 'YouTube',
                    'description' => 'На нашем YouTube-канале вы найдете множество видеоуроков по веб-разработке. Мы предлагаем подробные инструкции, практические примеры и проекты, которые помогут вам освоить необходимые навыки. Подписывайтесь, чтобы не пропустить новые видео и стать экспертом в веб-разработке!'
                ],
                [
                    'url' => 'https://rutube.ru/channel/44511402/',
                    'img' => 'rutube.png',
                    'name' => 'Rutube',
                    'description' => 'Добро пожаловать на наш канал Rutube, где мы делимся знаниями о веб-разработке! Изучите HTML, CSS и JavaScript с нашими увлекательными уроками, подходящими как для начинающих, так и для опытных разработчиков. Погрузитесь в продвинутые техники, практические проекты и полезные советы, которые помогут вам стать настоящим профессионалом в этой области.'
                ],
                [
                    'url' => 'https://dzen.ru/developerblog',
                    'img' => 'dzen.png',
                    'name' => 'Dzen',
                    'description' => 'На нашем канале Dzen вы найдете актуальные и интересные статьи по программированию. Мы охватываем популярные языки и технологии, такие как HTML, CSS, JavaScript и C++. Присоединяйтесь к нам, чтобы расширить свои знания и оставаться в курсе последних трендов в мире веб-разработки!'
                ],
                [
                    'url' => 'https://t.me/DmitryErmilov0',
                    'img' => 'telegram.png',
                    'name' => 'Telegram',
                    'description' => 'Присоединяйтесь к нашему каналу в Telegram, где я, ваш виртуальный помощник, помогу вам освоить веб-разработку. Мы предлагаем поддержку в разработке дизайна, обучении HTML, CSS и JavaScript, а также советы по оптимизации производительности и SEO. Начните свой путь к успеху в веб-разработке прямо сейчас!'
                ],
            ];
            ?>

            <!-- Вставка элементов в HTML -->
            <?php foreach ($items as $item): ?>
                <div class="flex flex-col items-center transition-transform transform hover:scale-105 group my-2">
                    <a href="<?= $item['url'] ?>" target="_blank" class="flex flex-col items-center">
                        <img src="<?= IMGS_PATH . '/' . $item['img'] ?>" alt="<?= $item['name'] ?>"
                            class="w-full h-auto max-w-[150px] mb-2" />
                        <span class="text-4xl font-bold my-2"><?= $item['name'] ?></span>
                    </a>
                    <p class="text-center max-h-16 overflow-hidden transition-all duration-300 description">
                        <?= $item['description'] ?>
                    </p>
                    <button class="mt-2 text-blue-500 toggle-description">Читать дальше</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-description').forEach(button => {
            button.addEventListener('click', () => {
                const description = button.previousElementSibling;
                const isExpanded = description.classList.toggle('max-h-40'); // Toggle class for expanded state
                description.style.maxHeight = isExpanded ? `${description.scrollHeight}px` : '4rem'; // Set max-height accordingly
                button.textContent = isExpanded ? 'Скрыть описание' : 'Читать дальше';
            });
        });
    </script>

    <style>
        .description {
            max-height: 4rem;
            /* Initial height */
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
    </style>
</body>

</html>