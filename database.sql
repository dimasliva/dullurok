CREATE TABLE IF NOT EXISTS roles (
    id INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS courses (
    id INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    course_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role_id` INT(20) UNSIGNED,  -- Новая колонка для роли
    `course_id` INT(20) UNSIGNED,  -- Новая колонка для курса
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Новая колонка для времени создания
    PRIMARY KEY (`id`),
    FOREIGN KEY (`role_id`) REFERENCES roles(`id`),  -- Внешний ключ для роли
    FOREIGN KEY (`course_id`) REFERENCES courses(`id`)  -- Внешний ключ для курса
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO roles (role_name) VALUES
('Admin'),
('Student');

INSERT INTO courses (course_name, description) VALUES
('HTML CSS', 'Learn the basics of programming using Python.'),
('Javascript', 'Understand the principles of database design and SQL.'),
('C++ SDL2', 'Create dynamic websites using HTML, CSS, and JavaScript.');

INSERT INTO `users` (email, username, password, role_id, course_id) VALUES
('user1@example.com', 'user1', 'password1', 1, 1),  -- Студент, курс 1
('user2@example.com', 'user2', 'password2', 2, 2),  -- Инструктор, курс 2
('user3@example.com', 'user3', 'password3', 2, 3);  -- Студент, курс 3

CREATE TABLE IF NOT EXISTS `events` (
    `id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(20) UNSIGNED NOT NULL,  -- Внешний ключ для связи с пользователем
    `event_date` DATETIME NOT NULL,  -- Дата и время события
    `description` TEXT,  -- Описание события
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE  -- Внешний ключ для связи с пользователем
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `events` (`user_id`,  `event_date`, `description`) VALUES
(1,  '2024-12-15 18:00:00', 'Обсуждение основ SQL и практические задачи.'),
(1,  '2024-12-30 10:00:00', 'Введение в программирование на Python.'),
(1, '2024-11-01 14:00:00',  'Изучение основ JavaScript и его применения.'),
(1,  '2025-01-10 16:00:00', 'Практические занятия по графическому дизайну.'),
(1, '2025-02-25 09:00:00', 'Обсуждение новых технологий и трендов в ИТ.');
-- Создание таблицы категорий
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Заполнение таблицы категорий
INSERT INTO `categories` (name) VALUES
('Technology'),
('Science'),
('Health'),
('Education'),
('Entertainment'),
('Sports'),
('Travel'),
('Lifestyle');

-- Создание таблицы статей
CREATE TABLE IF NOT EXISTS `articles` (
    `id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `userId` INT(20) UNSIGNED NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `category_id` INT,
    `content` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Заполнение таблицы статей
INSERT INTO `articles` (userId, title, category_id, content) VALUES
(1, 'The Rise of AI', 1, 'Artificial Intelligence (AI) is rapidly transforming various industries.'),
(2, 'The Wonders of Space', 2, 'Space exploration has unveiled many mysteries of the universe.'),
(1, 'Healthy Living Tips', 3, 'Incorporating healthy habits can significantly improve your life.'),
(3, 'The Importance of Education', 4, 'Education is a fundamental right and essential for personal development.'),
(2, 'Top 10 Movies of 2023', 5, 'A roundup of the most popular films released this year.'),
(1, 'Latest Sports Highlights', 6, 'Catch up on the latest sports events and highlights.'),
(3, 'Traveling the World', 7, 'Exploring new cultures and places is an enriching experience.'),
(2, 'The Art of Cooking', 8, 'Cooking is not just a necessity, but a form of art.');

CREATE TABLE IF NOT EXISTS `lessons` (
    `id` INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `file` VARCHAR(255),
    `video` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Заполнение таблицы уроков
INSERT INTO `lessons` (file, video) VALUES
('/upload/lesson1.zip', 'https://rutube.ru/play/embed/cbff38f0459847008167bde434bf04cd'),
('/upload/lesson2.zip', 'https://rutube.ru/play/embed/cbff38f0459847008167bde434bf04cd'),
('/upload/lesson3.zip', 'https://rutube.ru/play/embed/cbff38f0459847008167bde434bf04cd');

CREATE TABLE IF NOT EXISTS `user_lessons` (
    `user_id` INT(20) UNSIGNED NOT NULL,
    `lesson_id` INT(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`user_id`, `lesson_id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`lesson_id`) REFERENCES lessons(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user_lessons` (user_id, lesson_id) VALUES
(1, 1),  
(1, 2),  
(2, 1),  
(2, 3),  
(3, 2);
