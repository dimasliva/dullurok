<?php
require_once("models/Database.php");

interface EventInterface
{
    public function getEventsByUserId($userId);
    public function createEvent($userId, $description, $eventDate);
    public function getAllEvents(); // Добавляем метод в интерфейс
    public function getId();
    public function getUserId();
    public function getDescription();
    public function getEventDate();
}

class EventModel implements EventInterface
{
    private $db;
    private $id;
    private $userId;
    private $description;
    private $eventDate;
    private $username; // Добавляем свойство username

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    // Метод для получения всех событий по user_id
    public function getEventsByUserId($userId)
    {
        $query = "SELECT * FROM events WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userId); // 'i' означает, что параметр - это целое число
        $stmt->execute();

        // Получаем результат
        $result = $stmt->get_result();

        // Возвращаем все события как ассоциативный массив
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Метод для создания нового события
    public function createEvent($userId, $description, $eventDate)
    {
        // Преобразуем дату из формата ISO 8601 в формат MySQL
        $dateTime = new DateTime($eventDate);
        $formattedDate = $dateTime->format('Y-m-d H:i:s'); // Преобразуем в формат MySQL

        $query = "INSERT INTO events (user_id, description, event_date) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iss', $userId, $description, $formattedDate); // 'i' - целое, 's' - строка
        if ($stmt->execute()) {
            $this->id = $stmt->insert_id; // Сохраняем ID нового события, если нужно
            return true; // Возвращаем true, если событие успешно создано
        }
        return false; // Возвращаем false в случае ошибки
    }

    /**
     * @return EventModel[] Массив объектов CourseModel
     */
    public function getAllEvents()
    {
        $query = "SELECT * FROM events";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        // Получаем результат
        $result = $stmt->get_result();

        // Создаем массив объектов EventModel
        $events = [];
        while ($data = $result->fetch_assoc()) {
            $event = new EventModel(); // Создаем новый объект события
            $event->setData($data); // Устанавливаем данные из базы данных
            $events[] = $event; // Добавляем объект в массив
        }
        return $events; // Возвращаем массив объектов
    }
    // Метод для обновления события
    public function updateEvent($id, $userId, $description, $eventDate)
    {
        $dateTime = new DateTime($eventDate);
        $formattedDate = $dateTime->format('Y-m-d H:i:s');

        $query = "UPDATE events SET user_id = ?, description = ?, event_date = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issi', $userId, $description, $formattedDate, $id);

        return $stmt->execute(); // Возвращаем результат выполнения
    }

    // Метод для удаления события
    public function deleteEvent($id)
    {
        $query = "DELETE FROM events WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);

        return $stmt->execute(); // Возвращаем результат выполнения
    }
    public function setData($data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['user_id'])) {
            $this->userId = $data['user_id'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['event_date'])) {
            $this->eventDate = $data['event_date'];
        }
        // Устанавливаем username, если он есть в данных
        if (isset($data['username'])) {
            $this->username = $data['username'];
        }
    }
    // Метод для получения имени пользователя
    public function getUsername()
    {
        return $this->username;
    }
    // Реализация методов интерфейса для получения значений полей
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getEventDate()
    {
        return $this->eventDate;
    }
}
