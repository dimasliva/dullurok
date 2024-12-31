<?php
require_once("models/Database.php");

// Определяем интерфейс LessonInterface
interface LessonInterface
{
    public function getId(): int;
    public function getFile(): ?string;
    public function getVideo(): ?string;
    public function getCreatedAt(): string;

    public function setFile(?string $file): void;
    public function setVideo(?string $video): void;
    public function setId(int $id): void; // Добавляем метод для установки ID
    public function setCreatedAt(string $createdAt): void; // Добавляем метод для установки createdAt

    // Добавляем методы для создания и получения урока
    public function createLesson(array $file, string $video): ?int;
    public function getLesson(int $id): ?LessonInterface;
    public function updateLesson(int $id, ?array $file, string $video): bool; // Новый метод
    public function deleteLesson(int $id): bool; // Новый метод для удаления урока

}

class LessonModel implements LessonInterface
{
    private int $id;
    private ?string $file;
    private ?string $video;
    private string $createdAt;

    public function __construct()
    {
        $this->id = 0; // Инициализация id
        $this->file = null; // Инициализация file
        $this->video = null; // Инициализация video
        $this->createdAt = date('Y-m-d H:i:s'); // Инициализация createdAt с текущей датой и временем

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setFile(?string $file): void
    {
        $this->file = $file;
    }

    public function setVideo(?string $video): void
    {
        $this->video = $video;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    // Метод для создания нового урока
    public function createLesson(array $file, string $video): ?int
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Ошибка загрузки файла.");
        }

        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['zip'];
        if (!in_array($fileExtension, $allowedfileExtensions)) {
            throw new Exception("Недопустимый формат файла. Допустимые форматы: " . implode(", ", $allowedfileExtensions));
        }

        $newFileName = date('Ymd_His') . '_' . uniqid() . '.' . $fileExtension;
        $uploadFileDir = './upload/';
        $dest_path = $uploadFileDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            throw new Exception("Произошла ошибка при загрузке файла.");
        }

        $this->setFile($newFileName);
        $this->setVideo($video);

        $mysqli = Database::getConnection();
        $sql = "INSERT INTO lessons (file, video) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $this->file, $this->video);

        if (!$stmt->execute()) {
            throw new Exception("Ошибка при добавлении урока: " . $stmt->error);
        }

        $this->setId($mysqli->insert_id);
        return $this->getId();
    }
    /**
     * @return LessonModel[] Массив объектов CourseModel
     */
    public static function getAllLessons(): array
    {
        $mysqli = Database::getConnection(); // Получаем соединение с базой данных

        $sql = "SELECT * FROM lessons"; // SQL-запрос для получения всех уроков
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $lessons = []; // Массив для хранения объектов уроков

        // Перебираем все строки результата и создаем объекты LessonModel
        while ($row = $result->fetch_assoc()) {
            $lesson = new LessonModel();
            $lesson->setId($row['id']);
            $lesson->setFile($row['file']);
            $lesson->setVideo($row['video']);
            $lesson->setCreatedAt($row['created_at']);
            $lessons[] = $lesson; // Добавляем объект в массив
        }

        return $lessons; // Возвращаем массив объектов LessonModel
    }
    // Функция для получения урока из базы данных
    public function getLesson(int $id): ?LessonInterface
    {
        $mysqli = Database::getConnection(); // Получаем соединение с базой данных

        $sql = "SELECT * FROM lessons WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $lesson = new LessonModel();
            $lesson->setId($row['id']);
            $lesson->setFile($row['file']);
            $lesson->setVideo($row['video']);
            $lesson->setCreatedAt($row['created_at']);

            return $lesson; // Возвращаем объект LessonModel
        }

        return null; // Если урок не найден
    }
    public function deleteLesson(int $id): bool
    {
        $mysqli = Database::getConnection(); // Получаем соединение с базой данных

        // Сначала получаем имя файла из базы данных
        $sql = "SELECT file FROM lessons WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $fileName = $row['file']; // Получаем имя файла
            $filePath = './upload/' . $fileName; // Полный путь к файлу

            // Удаляем файл из файловой системы, если он существует
            if (file_exists($filePath)) {
                unlink($filePath); // Удаляем файл
            }
        } else {
            echo "Урок не найден.";
            return false; // Урок не найден
        }

        // Удаляем запись из базы данных
        $sql = "DELETE FROM lessons WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute(); // Возвращаем результат выполнения запроса
    }

    public function updateLesson(int $id, ?array $file, string $video): bool
    {
        // Получаем текущее имя файла из базы данных
        $mysqli = Database::getConnection();
        $sql = "SELECT file FROM lessons WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $oldFileName = $row['file']; // Сохраняем старое имя файла
            $oldFilePath = './upload/' . $oldFileName; // Полный путь к старому файлу
        } else {
            echo "Урок не найден.";
            return false;
        }

        // Проверка на наличие файла и отсутствие ошибок
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Укажите допустимые расширения файлов (только zip)
            $allowedfileExtensions = array('zip');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Генерация нового имени файла с текущей датой и временем
                $newFileName = date('Ymd_His') . '_' . uniqid() . '.' . $fileExtension;

                // Укажите путь для загрузки файла
                $uploadFileDir = './upload/';
                $dest_path = $uploadFileDir . $newFileName;

                // Переместите файл в целевую папку
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Файл успешно загружен
                    $this->setFile($newFileName); // Сохраняем новое имя файла в объекте
                    $this->setVideo($video); // Сохраняем видео в объекте

                    // Удаляем старый файл, если он существует
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // Удаляем старый файл
                    }

                    // Обновляем информацию в базе данных
                    $sql = "UPDATE lessons SET file=?, video=? WHERE id=?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param("ssi", $this->file, $this->video, $id); // 'ssi' означает, что два параметра - строки, один - целое число

                    return $stmt->execute(); // Возвращаем результат выполнения запроса
                } else {
                    echo "Произошла ошибка при загрузке файла.";
                    return false;
                }
            } else {
                echo "Недопустимый формат файла. Допустимые форматы: " . implode(", ", $allowedfileExtensions);
                return false;
            }
        } else {
            echo "Ошибка загрузки файла.";
            return false;
        }
    }

}
?>