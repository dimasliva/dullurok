<?php

require_once("models/EventModel.php");

$userId = $_SESSION['userId'];

$eventModel = new EventModel();
$events = $eventModel->getEventsByUserId($userId);

// Преобразуем события в формат, удобный для JavaScript
$eventsArray = [];
foreach ($events as $event) {
    $eventsArray[] = [
        'id' => $event['id'],
        'description' => $event['description'],
        'event_date' => $event['event_date'],
    ];
}

$eventsJson = json_encode($eventsArray);
?>
<script src="templates/components/calendar/calendar.js" defer></script>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <div class="bg-gray-800 rounded-lg shadow-lg p-5 w-80">
        <div class="flex justify-between items-center mb-4">
            <button id="prevMonth" class="bg-gray-700 hover:bg-gray-600 p-2 rounded">«</button>
            <h2 id="monthYear" class="text-lg font-bold"></h2>
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
        <div class="bg-gray-800 rounded-lg p-5 w-80">
            <h3 id="modalTitle" class="text-lg font-bold mb-2"></h3> <!-- Изменено id на modalTitle -->
            <div id="modalContent" class="text-white"></div>
            <button id="closeModal" class="mt-4 bg-gray-700 hover:bg-gray-600 p-2 rounded">Закрыть</button>
        </div>
    </div>

    <script>
        const events = <?php echo $eventsJson; ?>; // Передаем события в JavaScript
        const calendar = document.getElementById("calendar");
        const monthYear = document.getElementById("monthYear");
        const prevMonthButton = document.getElementById("prevMonth");
        const nextMonthButton = document.getElementById("nextMonth");

        let currentDate = new Date();

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
            const modalTitle = document.getElementById("modalTitle");


            modalContent.innerHTML = dayEvents.map(event => {
                const eventTime = event.event_date.split(' ')[1]; // Получаем время события
                modalTitle.textContent = `Занятие на ${date} ${eventTime}`; // Устанавливаем заголовок с датой
                return `<div>${event.description}</div>`; // Добавляем время к описанию
            }).join("");
            modal.classList.remove("hidden");

            const closeModalButton = document.getElementById("closeModal");
            closeModalButton.onclick = () => {
                modal.classList.add("hidden");
            };

            modal.onclick = (event) => {
                if (event.target === modal) {
                    modal.classList.add("hidden");
                }
            };
        }

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
</body>

</html>