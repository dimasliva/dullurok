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
    <title><?= LOGIN_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>
    <section class="bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-gray-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl">
                        Войти в аккаунт
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium">Username</label>
                            <input type="text" name="username" id="username" placeholder="Ваше имя пользователя"
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium">Пароль</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required="">
                        </div>
                        <button type="submit"
                            class="w-full text-white pointer bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Создать
                            аккаунт</button>
                        <div>
                            <?php if (!empty($errors)): ?>
                                <?php foreach ($errors as $error): ?>
                                    <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                                        <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <p class="text-sm font-light text-gray-400">
                            У вас нет аккаунта? <a href="<?= REGISTER_PAGE['url'] ?>"
                                class="font-medium text-primary-600 hover:underline">Создайте
                                здесь</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>