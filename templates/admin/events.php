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

        <form id="eventForm" action="" method="POST" class="bg-gray-800 p-4 rounded-lg shadow-md">
            <input type="hidden" name="event_id" id="event_id">
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
                    <th class="py-2 text-center">ID</th>
                    <th class="py-2 text-center">Пользователь</th>
                    <th class="py-2 text-center">Описание</th>
                    <th class="py-2 text-center">Дата события</th>
                    <th class="py-2 text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventsWithUsernames as $event): ?>
                    <tr>
                        <td class="py-2 text-center"><?= htmlspecialchars($event->getId()) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($event->getUsername()) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($event->getDescription()) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($event->getEventDate()) ?></td>
                        <td class="py-2 text-center">
                            <form action="" method="POST" class="inline">
                                <input type="hidden" name="event_id" value="<?= $event->getId() ?>">
                                <button type="submit" name="delete"
                                    class="bg-red-600 text-white px-2 py-1 rounded">Удалить</button>
                            </form>
                            <button class="bg-blue-600 text-white px-2 py-1 rounded edit-button"
                                data-id="<?= htmlspecialchars($event->getId()) ?>"
                                data-user="<?= htmlspecialchars($event->getUserId()) ?>"
                                data-description="<?= htmlspecialchars($event->getDescription()) ?>"
                                data-date="<?= htmlspecialchars($event->getEventDate()) ?>">Редактировать</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function () {
                const eventId = this.getAttribute('data-id');
                const userId = this.getAttribute('data-user');
                const description = this.getAttribute('data-description');
                const eventDate = this.getAttribute('data-date');

                document.getElementById('event_id').value = eventId;
                document.getElementById('user_id').value = userId;
                document.getElementById('description').value = description;
                document.getElementById('event_date').value = eventDate;

                const submitButton = document.querySelector('input[type="submit"]');
                submitButton.value = "Обновить событие";
                submitButton.name = "update"; // Устанавливаем имя кнопки как "update"
            });
        });
    </script>
</body>

</html>