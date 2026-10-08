# ЛПР 8 — Нестеренко Егор, Ис24-23Б (N = 14, вариант 14 «Аптека»)

## Параметры (карточка)
V=14, SLUG=nesterenko, PORT=8114, ITEMS=7, CODE_L=2, CODE_D=4 (код вида PS-0101),
DB=lpr_nesterenko, PER_PAGE=5, MIN_LEN=4, STR_LEN=142, SEED=26, PARENTS=5,
ON_DELETE=restrict, SORT=сначала новые, FORMAT=B, STAT=min

## Установка
    composer create-project laravel/laravel lpr-nesterenko
    cd lpr-nesterenko
    git init
    git config user.name "Нестеренко Егор"
    git config user.email "ваша_почта@example.com"
    git add . && git commit -m "ЛПР8 п.1: установка Laravel"

1. Скопируйте папки app, config, resources, routes из архива поверх проекта (routes/web.php заменить).
2. Внесите строки из env-additions.txt в .env и поставьте актуальный LAB_CODE.
3. php artisan serve --port=8114 -> http://127.0.0.1:8114
4. Коммиты по пунктам: п.2 (.env, config/lab.php), п.3 (маршрут hello), п.4 (контроллеры), п.5 (Blade), п.6 (форма).
