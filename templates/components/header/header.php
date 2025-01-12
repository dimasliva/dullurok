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
<style>
    .burger-menu svg {
        width: 20px;
        height: 20px;
        filter: invert(100%) sepia(100%) saturate(2%) hue-rotate(161deg) brightness(107%) contrast(100%);
    }

    .user_circle svg {
        cursor: pointer;
        height: 100%;
        filter: invert(100%) sepia(100%) saturate(2%) hue-rotate(161deg) brightness(107%) contrast(100%);
    }

    .dropdown {
        display: none;
    }

    .dropdown.open {
        display: block;
    }
</style>
<script src="/templates/components/header/header.js" defer></script>

<nav class="bg-gray-900 shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 right-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button id="mobile-menu-button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Открыть главное меню</span>
                    <span class="burger-menu">
                        <?php include(SVGS_PATH . '/burger-menu.svg') ?>
                    </span>
                </button>
            </div>

            <div class="flex-1 flex items-center justify-between sm:items-stretch sm:justify-between">


                <div class="flex items-center">
                    <?php if (isset($_SESSION['loggedin'])): ?>
                        <button id="toggle-sidebar" class="p-2 mr-2 bg-gray-800 rounded focus:outline-none">
                            <span class="burger-menu">
                                <?php include(SVGS_PATH . '/burger-menu.svg') ?>
                            </span>
                        </button>
                    <?php endif; ?>
                    <h1 class="flex items-center text-xl font-bold"><?= LOGO_NAME ?></h1>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="<?= HOME_PAGE['url'] ?>"
                            class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= HOME_PAGE['name'] ?></a>

                        <a href="<?= TUTORIALS_PAGE['url'] ?>"
                            class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= TUTORIALS_PAGE['name'] ?></a>

                        <a href="<?= SOCIALS_PAGE['url'] ?>"
                            class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= SOCIALS_PAGE['name'] ?></a>


                        <?php if (isset($_SESSION['loggedin'])): ?>


                            <a href="<?= DONATION_PAGE['url'] ?>"
                                class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= DONATION_PAGE['name'] ?></a>

                            <div class="relative">
                                <span class="user_circle cursor-pointer" id="userCircle">
                                    <?php include(SVGS_PATH . '/user-circle.svg') ?>
                                </span>
                                <div class="dropdown absolute right-0 mt-2 w-48 bg-gray-800 shadow-lg rounded-md"
                                    id="dropdownMenu">
                                    <ul class="py-2">
                                        <li>
                                            <?php if (isset($_SESSION['userRoleId'])): ?>
                                                <a href="<?= ADMIN_PAGE['url'] ?>"
                                                    class="block px-4 py-2 text-white hover:bg-gray-700"><?= ADMIN_PAGE['name'] ?></a>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <a href="<?= CABINET_PAGE['url'] ?>"
                                                class="block px-4 py-2 text-white hover:bg-gray-700"><?= CABINET_PAGE['name'] ?></a>
                                        </li>
                                        <li>
                                            <form method="POST" action="">
                                                <button
                                                    class="block w-full px-4 py-2 text-left text-white hover:bg-gray-700"
                                                    type="submit" name="exit">
                                                    Выйти
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            </div>
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
            <!-- Sidebar -->
            <div id="sidebar"
                class="fixed inset-y-0 left-0 bg-gray-800 w-64 transform -translate-x-full transition-transform duration-300">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-4">Навигация</h2>
                    <ul>
                        <li class="mb-2"><a href="<?= CABINET_PAGE['url'] ?>"
                                class="text-blue-400 hover:underline"><?= CABINET_PAGE['name'] ?></a></li>
                        <li class="mb-2"><a href="<?= CABINET_LESSONS_PAGE['url'] ?>"
                                class="text-blue-400 hover:underline"><?= CABINET_LESSONS_PAGE['name'] ?> </a></li>
                        <li class="mb-2"><a href=<?= BUY_LESSON_PAGE['url'] ?>
                                class="text-blue-400 hover:underline"><?= BUY_LESSON_PAGE['name'] ?></a></li>
                    </ul>
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