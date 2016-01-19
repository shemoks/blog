 php yii migrate --migrationPath=@yii/rbac/migrations  # Миграция таблиц rbac из фреймворка
- в console/controllers/RbacController.php создала роли
- в common/components/rbac/UserRoleRule.php создала правила для ролей
- создала миграцию для добавления первого пользователя m160108_185342_admin_user
- php yii rbac/init 1    # Сделать первого пользователя - админом (прописано в console/controllers/RbacController.php) и заполнить таблицы
- через comoser добавила AdminLte тему и добавила стандартные layouts
_______________________________________________________________________________
- создала миграции для добавления таблиц category, post,category_post, comment в базу данных
- cоздала с помощью CRUD модели, контроллеры и вьюхи

В базе есть роли:
admin (вход в админку admin.blog/loc)
moder - не может удалять пользователя, имеет доступ к админке
user - при регистрации роль по умолчанию, за исключением того, что пользователь на форме может поставить
галочку - хочу писать посты, тогда присваивается роль blogger
user в отличае от guest может только комментировать посты
Ни user, ни blogger не могут создавать категории
В админке не создаются посты, а только редактируются админом и модератором
------------------------------------------------------------------------------------
Админ создан сразу при rbac миграции hp yii rbac/init 1 (shemshur пароль 123456)
------------------------------------------------------------------------------------

Во фронтенде к меню имеют доступ только blogger, moder,admin
-------------------------------------------------------------------------------------
В контенте отображаются только те посты, которым в админке админ выставил статус 1
-------------------------------------------------------------------------------------
Для выведения перечня категорий используется виджет, но таблица категорий должна быть заполнена (через админку)
--------------------------------------------------------------------------------------
