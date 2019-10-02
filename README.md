# spmsystem
Simple Product Management System

Для данного проекта использовался локальный сервер. Имя домена: spmsystem, папка домена: \spmsystem\public.
Файл экспорта БД MySQL находится в корне проекта под именем: spmsystem.sql

Начальная страница: http://spmsystem/store/1
На странице можно создать продукт, нажав на кнопку Create. На странице Create Product http://spmsystem/create, пользователь может ввести данные продукта(название, описание, цена), вибрать атрибуты и значения из доступных, загрузить изображение и нажать кнопку Add Product или же вернуться на начальную страницу. Если пользователь оставил поля заполнения пустыми, ввёл недостаточное количество символов или же неправильное значение и нажал кнопку Add Product, то страница перезагрузится, данные в БД не запишутся и рядом с этими полями появятся ошибки валидации.Если пользователь ввёл всё корректно, то запись появится в БД, а на странице показа, появится продукт пользователя с некоторыми атрибутами и действиями.

Продукт можно посмотреть, нажав на кнопку Show. Пользователь перейдёт на страницу http://spmsystem/show/{id} с подробной информацией о данном продукте.
Ещё, продукт можно редактировать, нажав на кнопку Edit. Пользователь перейдёт на страницу http://spmsystem/edit/{id}, где может вносить изменения.
Также, продукт можно удалить, нажав на кнопку Delete.
В проекте реализована пагинация - по две записи продукта на страницу, а также навигация между страницами.

Структура проекта:
Папка app/ - ядро проекта. В ней хранятся контроллери, модели и виды и файл start.php, в котором реализовано внедрение зависимостей и роутинг.
Папка public/ - в ней храняться: Front Controller (index.php), локальный конфигурационный файл вебсервера (.htaccess), папки с файлами js/ и css/, а также папка image/ (с favicon и примерами стандартных и тестовых изображений), и uploads/ с загруженными изображениями пользователей.
Файл composer.json - хранит в себе необходимые компоненты и автолоудинг.

Классы:
MainController - вызывает медоды моделей и передаёт полученные данные шаблону вида страницы.
Database - описывает логику работы проекта.
Pagination - реализованы методы пагинации и навигации.
Validation - реализует проверку и фильтрацию полученных пользовательских данных.
