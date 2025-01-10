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
    <title><?= ADMIN_EVENTS_PAGE['name'] ?></title>
</head>

<body class="bg-gray-900 text-white">
    <?php require_once("templates/components/header/header.php") ?>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4"><?= ADMIN_EVENTS_PAGE['name'] ?></h1>

        <form action="" method="POST" class="bg-gray-800 p-4 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium">ID пользователя:</label>
                <select id="user_id" name="user_id" required
                    class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->getId() ?>"><?= htmlspecialchars($user->getUsername()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="event_date" class="block text-sm font-medium">Дата и время события:</label>
                <input type="datetime-local" id="event_date" name="event_date" required
                    class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Описание события:</label>
                <textarea id="description" name="description" rows="4" cols="50"
                    class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <input type="submit" value="Создать событие" name="submit"
                class="mt-4 w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300">
        </form>

        <h2 class="text-xl font-bold mt-6">Существующие события:</h2>
        <table class="min-w-full bg-gray-800 text-white">
            <thead>
                <tr>
                    <th class="py-2">ID</th>
                    <th class="py-2">Пользователь</th>
                    <th class="py-2">Описание</th>
                    <th class="py-2">Дата события</th>
                    <th class="py-2">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventsWithUsernames as $event): ?>
                    <tr>
                        <td class="py-2"><?= htmlspecialchars($event->getId()) ?></td>
                        <td class="py-2"><?= htmlspecialchars($event->getUsername()) ?></td>
                        <!-- Используем метод getUsername -->
                        <td class="py-2"><?= htmlspecialchars($event->getDescription()) ?></td>
                        <!-- Используем метод getDescription -->
                        <td class="py-2"><?= htmlspecialchars($event->getEventDate()) ?></td>
                        <!-- Используем метод getEventDate -->
                        <td class="py-2">
                            <form action="" method="POST" class="inline">
                                <input type="hidden" name="event_id" value="<?= $event->getId() ?>">
                                <!-- Используем метод getId -->
                                <button type="submit" name="delete"
                                    class="bg-red-600 text-white px-2 py-1 rounded">Удалить</button>
                            </form>
                            <button
                                onclick="editEvent(<?= $event->getId() ?>, <?= $event->getUserId() ?>, '<?= htmlspecialchars($event->getDescription()) ?>', '<?= htmlspecialchars($event->getEventDate()) ?>')"
                                class="bg-blue-600 text-white px-2 py-1 rounded">Редактировать</button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <script>
        function editEvent(id, userId, description, eventDate) {
            document.getElementById('user_id').value = userId;
            document.getElementById('description').value = description;
            document.getElementById('event_date').value = eventDate;

            // Добавляем скрытое поле с ID события для обновления
            let form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `<input type="hidden" name="event_id" value="${id}"><input type="hidden" name="update" value="1">`;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>