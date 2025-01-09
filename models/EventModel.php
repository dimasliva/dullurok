<?php
require_once("models/Database.php");

interface EventInterface
{
    public function getEventsByUserId($userId);
    public function createEvent($userId, $description, $eventDate);
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

    // Метод для установки данных события (например, после извлечения из базы данных)
    public function setData($data)
    {
        $this->id = $data['id'];
        $this->userId = $data['user_id'];
        $this->description = $data['description'];
        $this->eventDate = $data['event_date'];
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
