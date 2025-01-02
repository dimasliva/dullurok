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
    <link rel="canonical" href="<?= URL_SITE ?><?= TUTORIALS_PAGE['url'] ?>" />
    <title><?= TUTORIALS_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900">
    <?php require_once("templates/components/header/header.php") ?>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4 text-white">Уроки</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php if (!empty($videos)): ?>
                <?php foreach ($videos as $video): ?>
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <img src="<?= $video->getPic() ?>" alt="<?= htmlspecialchars($video->getTitle()) ?>"
                            class="w-full h-auto object-contain">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-white"><?= htmlspecialchars($video->getTitle()) ?></h2>
                            <p class="text-gray-400"><?= htmlspecialchars($video->getDescription()) ?></p>
                            <a href="<?= VIDEO_PAGE['url'] . '/' . $video->getId() ?>"
                                class="mt-2 inline-block bg-blue-500 text-white py-2 px-4 rounded">Смотреть</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500">Нет уроков</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>