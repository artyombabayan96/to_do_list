<?php

namespace App\Consts;

class UserConsts
{
    const USERS_TABLE_NAME = 'users';
    const USERS_DEFAULT_USERNAME = 'admin';
    const USERS_DEFAULT_PASSWORD = '123';
    const AUTH_USERNAME_EMPTY_MESSAGE = 'Введите имя пользователя';
    const AUTH_PASSWORD_EMPTY_MESSAGE = 'Введите пароль';
    const AUTH_USERNAME_VALIDATION_MESSAGE = 'Имя пользователя должно содержать от 2 до 36 символов';
    const AUTH_PASSWORD_VALIDATION_MESSAGE = 'Пароль должен содержать от 2 до 36 символов';
    const AUTH_INVALID_CREDENTIALS_MESSAGE = 'Неверный пароль или имя пользователя';
    const AUTH_LOGIN_SUCCESS_MESSAGE = 'Вход успешно выполнен';
    const AUTH_LOGIN_FAILED_MESSAGE = 'При входе возникла ошибка';
    const AUTH_NOT_AUTHORIZED = 'Не зарегистрированным пользователям доступ запрещён';
}