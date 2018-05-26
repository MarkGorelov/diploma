<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 26.05.2018
 * Time: 15:30
 */

class TagController extends UserBase
{
    public function actionManage()
    {
        // проверка доступа
        self::checkAspirant();

        // получаем список компаний пользователя
        $tagsUser = array();
        $tagsUser = Tag::getTagsByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/tag/manage.php');
        return true;
    }

    /**
     * Action для страницы "Добавить новое учебное учреждение"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAspirant();

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                Tag::createTag($options);

                // Перенаправляем администартора на страницу управлениями учебным учреждением
                header("Location: /tag-manage/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/tag/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать учебное учреждение"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAspirant();

        // Получаем данные о конкретном учебном учреждение
        $tag = Tag::getTagById($id);

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            Tag::updateTagById($id, $options);
            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /tag-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/tag/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить учебное учреждение"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAspirant();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем учебное учреждение
            $tag = Tag::deleteTagById($id);

            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /tag-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/tag/delete.php');
        return true;
    }
}