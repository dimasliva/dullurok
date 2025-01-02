<?php
require_once("models/Database.php");


interface VideoModelInterface
{
    public function create(): bool; // Метод для добавления видео, возвращает true при успешном добавлении
    public function read(): array; // Метод для получения всех видео, возвращает объект mysqli_result
    public function readOne(int $id): ?VideoModelInterface; // Метод для получения видео по ID, возвращает ассоциативный массив или null
    public function update(): bool; // Метод для обновления видео, возвращает true при успешном обновлении
    public function delete(): bool; // Метод для удаления видео, возвращает true при успешном удалении
    // Публичные свойства
    public function getId(): int;
    public function getTitle(): string;
    public function getDescription(): string;
    public function getUrl(): string;
    public function getPic(): string;
}


class VideoModel implements VideoModelInterface
{
    private $conn;
    private $table_name = "videos";

    // Свойства видео
    public $id;
    public $title;
    public $description;
    public $url;
    public $pic; // Добавлено свойство для ссылки на изображение

    // Конструктор для инициализации соединения с БД
    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // Методы для получения значений свойств
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPic(): string
    {
        return $this->pic;
    }
    // Метод для добавления видео
    public function create(): bool
    {
        $query = "INSERT INTO " . $this->table_name . " (title, description, url, pic) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        // Привязываем параметры
        $stmt->bind_param('ssss', $this->title, $this->description, $this->url, $this->pic);

        // Выполняем запрос
        return $stmt->execute();
    }

    /**
     * @return VideoModelInterface[] Массив объектов VideoModel
     */
    public function read(): array
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result(); // Получаем результат
        $videos = [];

        // Извлекаем все строки результата и добавляем их в массив
        while ($row = $result->fetch_assoc()) {
            $video = new VideoModel(); // Создаем новый объект VideoModel
            $video->id = $row['id'];
            $video->title = $row['title'];
            $video->description = $row['description'];
            $video->url = $row['url'];
            $video->pic = $row['pic']; // Устанавливаем свойство pic

            $videos[] = $video; // Добавляем объект в массив
        }

        return $videos; // Возвращаем массив объектов VideoModel
    }


    /**
     * Метод для получения видео по ID
     * @return VideoModelInterface|null Возвращает объект VideoModel или null, если видео не найдено
     */
    public function readOne(int $id): ?VideoModelInterface
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id); // Привязываем параметр как integer
        $stmt->execute();

        $result = $stmt->get_result(); // Получаем результат
        $row = $result->fetch_assoc(); // Получаем ассоциативный массив

        // Проверяем, есть ли данные
        if ($row) {
            // Создаем новый объект VideoModel и устанавливаем его свойства
            $video = new VideoModel();
            $video->id = $row['id'];
            $video->title = $row['title'];
            $video->description = $row['description'];
            $video->url = $row['url'];
            $video->pic = $row['pic']; // Устанавливаем свойство pic

            return $video; // Возвращаем объект VideoModel
        }

        return null; // Если не найдено, возвращаем null
    }



    // Метод для обновления видео
    public function update(): bool
    {
        $query = "UPDATE " . $this->table_name . " SET title = ?, description = ?, url = ?, pic = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // Привязываем параметры
        $stmt->bind_param('ssssi', $this->title, $this->description, $this->url, $this->pic, $this->id);

        // Выполняем запрос
        return $stmt->execute();
    }

    // Метод для удаления видео
    public function delete(): bool
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id); // Привязываем параметр как integer

        // Выполняем запрос
        return $stmt->execute();
    }
}

