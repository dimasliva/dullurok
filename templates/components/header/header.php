<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit'])) {
    // Проверка нажатия кнопки "Выйти"

    session_destroy();
    header("Location:" . LOGIN_PAGE['url']);

    if (!isset($_SESSION['loggedin'])) {
        header("Location:" . LOGIN_PAGE['url']);
    }
}
?>
<script src="templates/components/header/header.js" defer></script>

<nav class="bg-gray-900 shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 right-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button id="mobile-menu-button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Открыть главное меню</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-between sm:items-stretch sm:justify-between">
                <h1 class="flex items-center text-xl font-bold"><?= LOGO_NAME ?></h1>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="<?= HOME_PAGE['url'] ?>"
                            class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= HOME_PAGE['name'] ?></a>

                        <a href="<?= TUTORIALS_PAGE['url'] ?>"
                            class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= TUTORIALS_PAGE['name'] ?></a>

                        <a href="<?= SOCIALS_PAGE['url'] ?>"
                            class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= SOCIALS_PAGE['name'] ?></a>


                        <?php if (isset($_SESSION['loggedin'])): ?>

                            <?php if (isset($_SESSION['userRoleId'])): ?>
                                <a href="<?= ADMIN_PAGE['url'] ?>"
                                    class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= ADMIN_PAGE['name'] ?></a>
                            <?php endif; ?>
                            <a href="<?= CABINET_PAGE['url'] ?>"
                                class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= CABINET_PAGE['name'] ?></a>
                            <a href="<?= DONATION_PAGE['url'] ?>"
                                class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= DONATION_PAGE['name'] ?></a>
                            <form method="POST" action="">
                                <button
                                    class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                    type="submit" name="exit">
                                    Выйти
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?= LOGIN_PAGE['url'] ?>"
                                class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= LOGIN_PAGE['name'] ?></a>

                            <a href="<?= REGISTER_PAGE['url'] ?>"
                                class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= REGISTER_PAGE['name'] ?></a>
                            <a href="<?= DONATION_PAGE['url'] ?>"
                                class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= DONATION_PAGE['name'] ?></a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="<?= HOME_PAGE['url'] ?>"
                class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= HOME_PAGE['name'] ?></a>
            <a href="<?= TUTORIALS_PAGE['url'] ?>"
                class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= TUTORIALS_PAGE['name'] ?></a>
            <a href="<?= SOCIALS_PAGE['url'] ?>"
                class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= SOCIALS_PAGE['name'] ?></a>

            <?php if (isset($_SESSION['loggedin'])): ?>
                <a href="<?= CABINET_PAGE['url'] ?>"
                    class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= CABINET_PAGE['name'] ?></a>
                <a href="<?= DONATION_PAGE['url'] ?>"
                    class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= DONATION_PAGE['name'] ?></a>
                <?php if (isset($_SESSION['userRoleId'])): ?>
                    <a href="<?= ADMIN_PAGE['url'] ?>"
                        class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= ADMIN_PAGE['name'] ?></a>
                <?php endif; ?>
                <form method="POST" action="">
                    <button
                        class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        type="submit" name="exit">
                        Выйти
                    </button>
                </form>
            <?php else: ?>
                <a href="<?= LOGIN_PAGE['url'] ?>"
                    class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= LOGIN_PAGE['name'] ?></a>
                <a href="<?= REGISTER_PAGE['url'] ?>"
                    class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= REGISTER_PAGE['name'] ?></a>
                <a href="<?= DONATION_PAGE['url'] ?>"
                    class="text-white hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"><?= DONATION_PAGE['name'] ?></a>
            <?php endif; ?>
        </div>
    </div>

</nav>