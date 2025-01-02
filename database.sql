-- Создание таблицы ролей
CREATE TABLE IF NOT EXISTS roles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Создание таблицы курсов
CREATE TABLE IF NOT EXISTS courses (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    course_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Создание таблицы пользователей (предположительно, она уже существует)
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50),
    surname VARCHAR(50),
    role_id INT UNSIGNED,
    course_id INT UNSIGNED,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Создание таблицы уроков
CREATE TABLE IF NOT EXISTS lessons (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    file VARCHAR(255),
    video VARCHAR(255),
    user_id INT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Создание таблицы событий
CREATE TABLE IF NOT EXISTS events (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    event_date DATETIME NOT NULL,
    description TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Создание таблицы категорий
CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Создание таблицы статей
CREATE TABLE IF NOT EXISTS articles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userId INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    category_id INT UNSIGNED,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Таблица для хранения информации о видео
CREATE TABLE videos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Уникальный идентификатор видео
    title VARCHAR(255) NOT NULL,        -- Заголовок видео
    description TEXT,                    -- Описание видео
    url VARCHAR(255) NOT NULL,            -- Ссылка на видео
    pic VARCHAR(255) NOT NULL            -- Ссылка на видео
);

-- Таблица для хранения комментариев
CREATE TABLE comments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,   -- Уникальный идентификатор комментария
    video_id INT UNSIGNED NOT NULL,               -- Идентификатор видео, к которому относится комментарий
    comment TEXT NOT NULL,                -- Текст комментария
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Дата и время создания комментария
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE -- Связь с таблицей videos
);

-- Заполнение таблицы ролей
INSERT INTO roles (role_name) VALUES
('Admin'),
('Student');

-- Заполнение таблицы курсов
INSERT INTO courses (course_name, description) VALUES
('HTML CSS', 'Learn the basics of programming using HTML and CSS.'),
('Javascript', 'Understand the principles of database design and SQL.'),
('C++ SDL2', 'Create dynamic websites using C++ and SDL2.');

-- Заполнение таблицы пользователей
INSERT INTO users (email, username, password, name, surname, role_id, course_id) VALUES
('john.doe@example.com', 'johndoe', 'hashed_password_1', 'John', 'Doe', 1, 1),
('jane.smith@example.com', 'janesmith', 'hashed_password_2', 'Jane', 'Smith', 2, 2),
('alice.johnson@example.com', 'alicejohnson', 'hashed_password_3', 'Alice', 'Johnson', 2, 3),
('bob.brown@example.com', 'bobbrown', 'hashed_password_4', 'Bob', 'Brown', 2, 1);

-- Заполнение таблицы категорий
INSERT INTO categories (name) VALUES
('Technology'),
('Science'),
('Health'),
('Education'),
('Entertainment'),
('Sports'),
('Travel'),
('Lifestyle');

-- Заполнение таблицы статей
INSERT INTO articles (userId, title, category_id, content) VALUES
(1, 'The Rise of AI', 1, 'Artificial Intelligence (AI) is rapidly transforming various industries.'),
(2, 'The Wonders of Space', 2, 'Space exploration has unveiled many mysteries of the universe.'),
(1, 'Healthy Living Tips', 3, 'Incorporating healthy habits can significantly improve your life.'),
(3, 'The Importance of Education', 4, 'Education is a fundamental right and essential for personal development.'),
(2, 'Top 10 Movies of 2023', 5, 'A roundup of the most popular films released this year.'),
(1, 'Latest Sports Highlights', 6, 'Catch up on the latest sports events and highlights.'),
(3, 'Traveling the World', 7, 'Exploring new cultures and places is an enriching experience.'),
(2, 'The Art of Cooking', 8, 'Cooking is not just a necessity, but a form of art.');

-- Заполнение таблицы уроков
INSERT INTO lessons (file, video, user_id) VALUES
('lesson1.zip', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 1),
('lesson2.zip', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 1),
('lesson3.zip', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 2),
('lesson4.zip', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 3),
('lesson5.zip', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 2);

INSERT INTO videos (title, description, url, pic) VALUES
('Видеоурок по MySQL', 'Этот видеоурок объясняет основы работы с MySQL.', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 'https://pic.rutubelist.ru/video/2024-12-30/7d/86/7d86b45313c5de27257596e1b4362bca.jpg'),
('Как создать веб-сайт', 'В этом видео мы рассмотрим шаги по созданию веб-сайта.', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 'https://pic.rutubelist.ru/video/2024-12-30/7d/86/7d86b45313c5de27257596e1b4362bca.jpg'),
('Изучаем Python', 'В этом видео мы начнем изучение языка программирования Python.', 'https://rutube.ru/play/embed/9e37e6db0cc6a20a34bc7645f67a83d9', 'https://pic.rutubelist.ru/video/2024-12-30/7d/86/7d86b45313c5de27257596e1b4362bca.jpg');

INSERT INTO comments (video_id, comment) VALUES
(1, 'Отличное видео! Очень полезно.'),
(1, 'Спасибо за объяснение.'),
(2, 'Хорошие советы по созданию сайтов.'),
(2, 'С нетерпением жду следующую часть.'),
(3, 'Очень интересно!'),
(3, 'Не могли бы вы объяснить подробнее?');
