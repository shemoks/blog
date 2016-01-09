 php yii migrate --migrationPath=@yii/rbac/migrations  # Миграция таблиц rbac из фреймворка
- в console/controllers/RbacController.php создала роли
- в common/components/rbac/UserRoleRule.php создала правила для ролей
- создала миграцию для добавления первого пользователя m160108_185342_admin_user
- php yii rbac/init 1    # Сделать первого пользователя - админом (прописано в console/controllers/RbacController.php) и заполнить таблицы
- через comoser добавила AdminLte тему и добавила стандартные layouts