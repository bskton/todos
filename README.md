Мои задания
===========

  * Можно создавать списки задач.  
  * В списках задач можно создавать задачи для определенного списка. 
  * Выводить задачи отсортированные по спискам.
  * Задачи можно помечать как выполненные и они должны пропадать из списка задач.

Установка
---------

  * git clone https://github.com/bskton/todos.git

  * cd todos; composer install

  * Введите имя базы данных (параметр database_name)

  * Введите имя пользователя для базы данных (параметр database_user)

  * Введите пароль пользователя для базы данных (параметр database_password)
  * Если вы выбрали пользователя root для бд, то выполните app/console doctrine:database:create (в этом случае сначала надо установить collation-server = utf8_general_ci и character-set-server = utf8 в my.cnf), иначе создайте базу данных database_name в ручную и предоставьте к ней доступ пользователю database_user.
 
  * app/console doctrine:schema:update --force

  * app/console server:run

  * Откройте в браузере http://localhost:8000/task
