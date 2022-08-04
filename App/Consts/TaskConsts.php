<?php

namespace App\Consts;

class TaskConsts
{
    const TASKS_TABLE_NAME = 'tasks';
    const TASKS_ID_COLUMN_NAME = 'task_id';
    const TASKS_TABLE_COLUMNS = ['task_id', 'username', 'email', 'task', 'status'];
    const TASKS_ORDER_VARIANTS = ['asc', 'desc'];
    const TASKS_DEFAULT_ORDER_COLUMN = 'username';
    const TASKS_DEFAULT_ORDER = 'asc';
    const TASKS_DEFAULT_PAGE = 1;
    const TASKS_SINGLE_PAGE_TASKS_COUNT = 3;
    const TASKS_EMPTY_MESSAGE = 'Список задач пуст. После добавлении задачи она будет отображена здесь';
    const TASKS_PAGE_EMPTY_MESSAGE = 'В списке задач не так много страниц';
    const TASK_SUCCESS_MESSAGE = 'Новая задача успешно создана';
    const TASK_UPDATED_MESSAGE = 'Задача успешно изменена';
    const TASK_FAILED_MESSAGE = 'При добавлении задачи возникла ошибка';
    const TASK_UPDATE_FAILED_MESSAGE = 'При изменении задачи возникла ошибка';
    const TASK_NOT_FOUND_MESSAGE = 'Задача с таким идентификатором не найдена';
    const TASK_ID_NOT_SET_MESSAGE = 'Не указан идентификатор задачи';
    const TASK_USERNAME_EMPTY_MESSAGE = 'Введите имя пользователя';
    const TASK_EMAIL_EMPTY_MESSAGE = 'Введите e-mail адрес';
    const TASK_TEXT_EMPTY_MESSAGE = 'Введите текст задачи';
    const TASK_STATUS_EMPTY_MESSAGE = 'Введите статус задачи';
    const TASK_USERNAME_VALIDATION_MESSAGE = 'Имя пользователя должно содержать от 2 до 36 символов';
    const TASK_EMAIL_VALIDATION_MESSAGE = 'Введите валидный e-mail адрес';
    const TASK_TEXT_VALIDATION_MESSAGE = 'Текст задачи должен содержать от 2 до 500 символов';
    const TASK_STATUS_VALIDATION_MESSAGE = 'Статус задачи должен содержать от 2 до 36 символов';
}