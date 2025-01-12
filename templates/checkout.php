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
    <title><?= CHECKOUT_PAGE['name'] ?></title>

</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Оформление заказа</h1>

        <form action="" method="POST">
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">Способ оплаты</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="radio" id="umoney" name="payment" value="umoney"
                            class="w-4 h-4 text-green-500 border-gray-300 focus:ring-green-500" checked>
                        <label for="umoney" class="ml-2 text-gray-300">ЮMoney</label>
                    </div>
                    <!-- <div class="flex items-center">
                        <input type="radio" id="bank" name="payment" value="bank"
                            class="w-4 h-4 text-green-500 border-gray-300 focus:ring-green-500">
                        <label for="bank" class="ml-2 text-gray-300">Банковский перевод</label>
                    </div> -->
                </div>
            </div>


            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Итого</h2>
                <div class="flex justify-between">
                    <span>Сумма заказа:</span>
                    <span class="font-bold"><?= $price ?></span>
                </div>
                <div class="flex justify-between mt-4 border-t border-gray-700 pt-2">
                    <span class="text-lg">Итого:</span>
                    <span class="text-lg font-bold"><?= $price ?>₽</span>
                </div>
                <div class="flex justify-center mt-6">
                    <button type="submit"
                        class="px-6 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                        Подтвердить заказ
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>