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
    <link rel=“canonical” href="<?= URL_SITE ?><?= DONATION_PAGE['url'] ?>" />
    <title><?= DONATION_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900">
    <?php require_once("templates/components/header/header.php") ?>
    <div class="container mx-auto p-6 flex flex-col items-center ">
        <h1 class="text-3xl font-bold mb-4">Пожертвование</h1>
        <div class="flex flex-col items-center  gap-4">
            <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=17GVS60BIVO.250102&" width="330"
                height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>​
            <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=17H009C6BM0.250102&" width="330"
                height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>​
            <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=17H00HG07G6.250102&" width="330"
                height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>​
            <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=17H00NGLAOF.250102&" width="330"
                height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>​
            <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=17H068DQT8C.250102&" width="330"
                height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>​
            <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=17H06ETNOJ5.250102&" width="330"
                height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>​
            <a href="https://yoomoney.ru/to/4100118953831535" target="_blank">
                <button
                    class="bg-blue-600 text-white font-bold flex items-center justify-center rounded-2xl hover:bg-blue-700"
                    style="width: 320px; height: 50px;">
                    Своя сумма
                </button>
            </a>

        </div>
    </div>
</body>

</html>