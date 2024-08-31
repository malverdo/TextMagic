# TextMagic

## Подъём
- `git clone git@github.com:malverdo/TextMagic.git`
- `docker build`
- `docker up -d`
- `docker exec dev_php_fpm composer install`
- `docker exec dev_php_fpm php bin/console doctrine:migrations:migrate`

## Swagger
- `http://localhost:2095/api/doc`

## Адрес
- `http://localhost:2095`

## Коры
- Postgres
  - `postgres`
  - `root`
  - `5432`

## DDD
- Архитектурный паттерн: Слоёная архитектура (3 уровня)
- Деление на Поддомен: Нет
- Паттерны интеграции: Нет
- Паттерны реализации бизнес-логики: Модель предметной области
- Ограниченный контекст: Нет
- Шаблоны проектирования: Да
- Open Host Service (OHS): Да
- Паттерны модели предметной области: 
  - Агрегаты: нет
  - Объекты значений: Да
  - Сервисы домена: Да
  - ACL: Нет
  - Модули: Нет