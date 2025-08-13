<?php
namespace app\models;

class KnowledgeBase
{
    public static function getData()
    {
        return [
            [
                'id' => 1,
                'name' => 'Потенциал и рост',
                'subtopics' => [
                    [
                        'id' => 1.1,
                        'title' => 'Скорость обучения',
                        'content' => "Освоил современный стек технологий за 12 месяцев:",
                        'highlights' => [
                            "AI: Midjourney → Stable Diffusion → Runway → KlingAI",
                            "Инструменты: от базового Python до FastAPI + PostgreSQL",
                            "JavaScript: от простых скриптов до ООП архитектур"
                        ]
                    ],
                    [
                        'id' => 1.2,
                        'title' => 'Гибкость мышления',
                        'content' => "Примеры адаптации к задачам:",
                        'highlights' => [
                            "На практике внедрил переводчик за 3 дня без опыта в NLP",
                            "Самостоятельно разобрался с телеграм-ботами для диплома",
                            "Освоил Docker для развертывания учебных проектов"
                        ]
                    ],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Технический стек',
                'subtopics' => [
                    [
                        'id' => 2.1,
                        'title' => 'Backend-разработка',
                        'content' => "Основные технологии:",
                        'highlights' => [
                            "Python: aiogram, FastAPI, pandas",
                            "Базы данных: проекты с PostgreSQL",
                            "Асинхронное программирование"
                        ]
                    ],
                    [
                        'id' => 2.2,
                        'title' => 'Frontend/Инструменты',
                        'content' => "Сопутствующие навыки:",
                        'highlights' => [
                            "JavaScript (ES6+, ООП, DOM)",
                            "Git: ветвление, merge-запросы",
                            "Docker: базовое развертывание"
                        ]
                    ],
                ]
            ],
            [
                'id' => 3,
                'name' => 'Практические проекты',
                'subtopics' => [
                    [
                        'id' => 3.1,
                        'title' => 'Telegram-бот для бизнеса',
                        'content' => "Дипломный проект:",
                        'highlights' => [
                            "Автоматизация заказов древесины",
                            "Интеграция с PostgreSQL",
                            "Снизил время обработки заказов на 40%"
                        ]
                    ],
                    [
                        'id' => 3.2,
                        'title' => 'Кросскультурный переводчик',
                        'content' => "Решение для компании:",
                        'highlights' => [
                            "Упрощение общения с иностранцами",
                            "Реализация на Python + googletrans",
                            "Внедрено в рабочий процесс"
                        ]
                    ],
                ]
            ],
        ];
    }

    public static function getSubtopicContent($subtopicId)
    {
        foreach (self::getData() as $category) {
            foreach ($category['subtopics'] as $subtopic) {
                if ($subtopic['id'] == $subtopicId) {
                    return $subtopic;
                }
            }
        }
        return null;
    }
}