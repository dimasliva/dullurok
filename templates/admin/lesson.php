<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Уроки по HTML, CSS и JavaScript. Научитесь создавать веб-страницы и разрабатывать интерфейсы.">
    <meta name="keywords" content="HTML, CSS, JavaScript, уроки, веб-разработка, <?= LOGO_NAME ?>">
    <link rel="canonical" href="<?= URL_SITE ?>" />
    <link rel="stylesheet" href=".<?= STYLES_PATH ?>/global.css" />
    <link rel="stylesheet" href=".<?= STYLES_PATH ?>/tailwind.css">
    <title><?= ADMIN_LESSON_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>

    <div class="px-4 mx-auto">
        <div class="w-96 mx-auto">
            <h1 class="text-2xl font-bold mb-4"><?= ADMIN_LESSON_PAGE['name'] ?></h1>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-4 rounded-lg shadow-md ">
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium">Файл:</label>
                    <input type="file" id="file" name="file" accept=".zip" required
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Введите путь к файлу">
                </div>

                <div class="mb-4">
                    <label for="video" class="block text-sm font-medium">Ссылка на видео:</label>
                    <input type="text" id="video" name="video" required
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Введите ссылку на видео">
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium">Выберите пользователя:</label>
                    <select id="user_id" name="user_id" required
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500">
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user->getId() ?>"><?= htmlspecialchars($user->getUsername()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" value="Создать урок" name="submit"
                    class="mt-4 w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300">
            </form>
        </div>



        <h2 class="text-xl font-bold mt-6 mb-4">Список уроков</h2>

        <table class="min-w-full bg-gray-800 rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-600">ID</th>
                    <th class="py-2 px-4 border-b border-gray-600">Файл</th>
                    <th class="py-2 px-4 border-b border-gray-600">Видео</th>
                    <th class="py-2 px-4 border-b border-gray-600">Дата создания</th>
                    <th class="py-2 px-4 border-b border-gray-600">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-600"><?= $lesson->getId() ?></td>
                        <td class="py-2 px-4 border-b border-gray-600"><?= htmlspecialchars($lesson->getFile()) ?></td>
                        <td class="py-2 px-4 border-b border-gray-600"><?= htmlspecialchars($lesson->getVideo()) ?></td>
                        <td class="py-2 px-4 border-b border-gray-600"><?= htmlspecialchars($lesson->getCreatedAt()) ?></td>
                        <td class="py-2 px-4 border-b border-gray-600 flex space-x-2">
                            <a href="#"
                                onclick="openModal(<?= $lesson->getId() ?>, '<?= htmlspecialchars($lesson->getVideo()) ?>')"
                                class="bg-blue-600 text-white py-1 px-3 rounded hover:bg-blue-700 transition duration-200">Редактировать</a>
                            <form action="" method="POST" class="inline-block">
                                <input type="hidden" name="deleteID" value="<?= $lesson->getId() ?>">
                                <input type="submit" name="delete" value="Удалить"
                                    class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700 transition duration-200 cursor-pointer">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Модальное окно для редактирования урока -->
        <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-gray-800 rounded-lg p-6 w-1/3">
                <h2 class="text-lg font-bold text-white mb-4">Редактировать урок</h2>
                <form id="editForm" action="update_lesson.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_lesson_id" id="edit_lesson_id">
                    <div class="mb-4">
                        <label for="edit_file" class="block text-sm font-medium text-gray-300">Файл</label>
                        <input type="file" name="edit_file" id="edit_file"
                            class="mt-1 block w-full border border-gray-600 bg-gray-700 text-white rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="edit_video" class="block text-sm font-medium text-gray-300">Видео</label>
                        <input type="text" name="edit_video" id="edit_video"
                            class="mt-1 block w-full border border-gray-600 bg-gray-700 text-white rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-2 px-4 py-2 bg-gray-600 text-white rounded"
                            onclick="closeModal()">Отмена</button>
                        <button type="submit" name="edit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <script>
        function openModal(id, video) {
            document.getElementById('edit_lesson_id').value = id; // Устанавливаем ID урока
            document.getElementById('edit_file').value = ''; // Очищаем поле файла (пользователь должен выбрать новый файл)
            document.getElementById('edit_video').value = video; // Устанавливаем текущее видео
            document.getElementById('editModal').classList.remove('hidden'); // Показываем модальное окно
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden'); // Скрываем модальное окно
        }
    </script>


</body>


</html>