<?php
require_once("models/EventModel.php");
// Получаем содержимое SVG
$svgContent = file_get_contents(SVGS_PATH . '/edit.svg');
$svgContent = addslashes($svgContent); // Экранируем содержимое для JavaScript
$userId = $_SESSION['userId'];

$eventModel = new EventModel();
$events = $eventModel->getEventsByUserId($userId);

// Функция для преобразования событий в формат JavaScript
function getEventsJs($events)
{
    $eventsArray = [];
    foreach ($events as $event) {
        $eventsArray[] = "{
            id: '{$event['id']}',
            description: '{$event['description']}',
            event_date: '{$event['event_date']}'
        }";
    }
    return "[" . implode(",", $eventsArray) . "]";
}

$eventsJs = getEventsJs($events);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_calendar_time'])) {
        $eventId = $_POST['event_id'];
        $description = $_POST['description'];
        $newTime = $_POST['new_time']; // e.g., '12:35'

        // Обновление события в базе данных
        $eventModel->updateEvent($eventId, $userId, $description, $newTime); // Pass the correct date

        // Получаем обновленный список событий
        $events = $eventModel->getEventsByUserId($userId);
        $eventsJs = getEventsJs($events); // Обновляем JavaScript массив событий
    }
}
?>
<script src="templates/components/calendar/calendar.js" defer></script>
<style>
    .edit-button {
        height: 24px;
    }

    .edit-button svg {
        width: 24px;
        height: 24px;
    }
</style>

<div class="bg-gray-800 rounded-lg shadow-lg p-5 w-80">
    <div class="flex justify-between items-center mb-4">
        <button id="prevMonth" class="bg-gray-700 hover:bg-gray-600 p-2 rounded">«</button>
        <div class="flex items-center">
            <h2 id="monthYear" class="text-lg font-bold"></h2>
        </div>
        <button id="nextMonth" class="bg-gray-700 hover:bg-gray-600 p-2 rounded">»</button>
    </div>
    <div class="grid grid-cols-7 text-center text-sm mb-2">
        <div class="font-bold">Пн</div>
        <div class="font-bold">Вт</div>
        <div class="font-bold">Ср</div>
        <div class="font-bold">Чт</div>
        <div class="font-bold">Пт</div>
        <div class="font-bold">Сб</div>
        <div class="font-bold">Вс</div>
    </div>
    <div id="calendar" class="grid grid-cols-7 text-center"></div>
</div>

<div id="modal" class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-gray-800 rounded-lg p-5 max-h-[80vh] overflow-auto">
        <pre id="modalContent" class="text-white overflow-auto flex flex-col gap-4"></pre>
        <button id="closeModal" class="mt-4 bg-gray-700 hover:bg-gray-600 p-2 rounded">Закрыть</button>
    </div>
</div>

<div id="editModal" class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-gray-800 rounded-lg p-5">
        <h2 class="text-lg font-bold mb-2">Редактировать время события</h2>
        <form id="editEventForm" action="" method="POST">
            <input type="hidden" id="event_id" name="event_id" value="" /> <!-- Скрытое поле для event_id -->
            <input id="editEventTime" type="datetime-local" name="new_time"
                class="bg-gray-700 text-white p-2 rounded mb-4" />
            <input type="hidden" id="description" name="description" value="" /> <!-- Здесь будет описание события -->
            <button id="saveEventTime" type="submit" name="update_calendar_time"
                class="bg-green-500 hover:bg-green-400 p-2 rounded">Сохранить</button>
            <button type="button" id="closeEditModal" class="bg-gray-700 hover:bg-gray-600 p-2 rounded">Закрыть</button>
        </form>
    </div>
</div>

<script>
    const events = <?php echo $eventsJs; ?>; // Передаем события в JavaScript
    const svg = `<?php echo $svgContent; ?>`; // Передаем SVG в JavaScript
    const calendar = document.getElementById("calendar");
    const monthYear = document.getElementById("monthYear");
    const prevMonthButton = document.getElementById("prevMonth");
    const nextMonthButton = document.getElementById("nextMonth");
    const editModal = document.getElementById("editModal");
    const editEventTimeInput = document.getElementById("editEventTime");
    const descriptionInput = document.getElementById("description");
    const closeEditModalButton = document.getElementById("closeEditModal");

    let currentDate = new Date();
    let selectedEvent = null;

    function renderCalendar(date) {
        calendar.innerHTML = "";
        const year = date.getFullYear();
        const month = date.getMonth();

        monthYear.textContent = date.toLocaleString("default", {
            month: "long",
            year: "numeric",
        });

        const firstDayOfMonth = new Date(year, month, 1);
        const lastDayOfMonth = new Date(year, month + 1, 0);
        const daysInMonth = lastDayOfMonth.getDate();
        const startDay = firstDayOfMonth.getDay();

        // Заполнение календаря пустыми ячейками для дней предыдущего месяца
        for (let i = 0; i < (startDay === 0 ? 6 : startDay - 1); i++) {
            const emptyCell = document.createElement("div");
            emptyCell.className = "p-2";
            calendar.appendChild(emptyCell);
        }

        // Заполнение календаря днями текущего месяца
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement("div");
            dayCell.className = "relative p-2 border border-gray-700 hover:bg-gray-700 cursor-pointer";
            dayCell.textContent = day;

            // Форматируем дату для сравнения
            const eventDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayEvents = events.filter(event => {
                const eventDateOnly = event.event_date.split(' ')[0]; // Дата без времени
                return eventDateOnly === eventDate;
            });
            dayCell.title = dayEvents.length ? "Ссылка на занятие" : 'Занятия нет';

            // Проверка на совпадение с текущей датой
            const today = new Date();
            if (today.getFullYear() === year && today.getMonth() === month && today.getDate() === day) {
                dayCell.classList.add("bg-blue-500");
            }

            if (dayEvents.length > 0) {
                const circle = document.createElement("div");
                circle.className = "absolute top-0 right-0 w-3 h-3 bg-green-500 rounded-full";
                dayCell.appendChild(circle);

                // Обработчик события клика для отображения модального окна
                dayCell.addEventListener("click", () => {
                    showModal(eventDate, dayEvents); // Передаем дату в showModal
                });
            }

            calendar.appendChild(dayCell);
        }
    }

    function showModal(date, dayEvents) {
        const modal = document.getElementById("modal");
        const modalContent = document.getElementById("modalContent");

        // Генерация HTML для событий
        modalContent.innerHTML = dayEvents.map(event => {
            const eventTime = event.event_date.split(' ')[1]; // Получаем время события
            const title = `Занятие на ${date} ${eventTime}`; // Формируем заголовок с датой
            return `
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <h2 class="text-lg font-bold mb-1">${title}</h2>
                    <span class="flex items-center cursor-pointer hover:text-blue-500 edit-button" data-id="${event.id}" data-time="${event.event_date}" data-description="${event.description}">
                        ${svg}
                    </span>
                </div>
                <p>${event.description}</p>
            </div>
        `;
        }).join("");

        // Отображение модального окна
        modal.classList.remove("hidden");

        // Закрытие модального окна
        const closeModalButton = document.getElementById("closeModal");
        closeModalButton.onclick = () => {
            modal.classList.add("hidden");
        };

        modal.onclick = (event) => {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        };

        // Добавление обработчиков для кнопок редактирования
        const editButtons = modalContent.querySelectorAll('.edit-button');
        editButtons.forEach(button => {
            button.onclick = (e) => {
                const eventId = button.getAttribute('data-id');
                const eventTime = button.getAttribute('data-time');
                const eventDescription = button.getAttribute('data-description');

                // Обновление полей ввода
                selectedEvent = events.find(event => event.id == eventId);
                editEventTimeInput.value = eventTime;
                descriptionInput.value = eventDescription; // Устанавливаем описание в скрытое поле
                document.getElementById("event_id").value = eventId; // Устанавливаем event_id в скрытое поле

                // Показать модальное окно редактирования
                editModal.classList.remove("hidden");
                modal.classList.add("hidden");
            };
        });
    }
    closeEditModalButton.onclick = () => {
        editModal.classList.add("hidden");
    };

    prevMonthButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    nextMonthButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    // Первоначальный рендер
    renderCalendar(currentDate);
</script>