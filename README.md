# Chai-Coffee тестовое задание

### Технологический стек
1. PHP 5.6
2. MySQL 5.7
3. Apache

## Рекомендуемый способ установки (локально)

### Необходимые компоненты
1. Git
2. Docker и Docker Compose

### Установка

1. **Клонировать репозиторий**:
    ```bash
    git clone https://github.com/ваш-username/chai-coffee.git
    cd chai-coffee
    ```
2. **Запустить Docker**:
    ```bash
    git compose up --build
    ```
    Тут необходимо будет подождать 2-3 минуты, чтобы MySQL база данных подготовилась к работе. 
    Проект будет доступен в браузере по адресу http://localhost

После тестирования остановить и удалить локально развернутый образ Докера командой
```bash
docker compose down -v
```
