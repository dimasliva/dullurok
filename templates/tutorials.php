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
    <link rel=“canonical” href="<?= URL_SITE ?><?= TUTORIALS_PAGE['url'] ?>" />
    <title><?= TUTORIALS_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900">
    <?php require_once("templates/components/header/header.php") ?>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Уроки</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


            <p class="text-gray-500">Нет уроков</p>
        </div>
    </div>
</body>

</html>