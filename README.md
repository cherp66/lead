# Тестовое задание

## Usage
Как обычно, git clone, composer update

## Using
Лучше запускать из консоли $ Lead

Можно по HTTP, но тогда не будет видно, сколько потрачено времени. С аяксом не стал мудрить.

В директории data/ должны появиться три файла:

  1.  log.txt (по ТЗ)
  2.  failed.txt (ID "необработанных" заявок)
  3.  meta.txt (диапазоны обработанных ID на случай, если отвалится какой то процесс)

При перезапуске файлы очищаются и формируются заново

В конфигурационном файле (resources/config.php) можно настроить систему

## Краткое описание.

Система собрана с помощью контейнера зависимостей PSR-11  (тоже моя разработка) в точке сбора composition\Assembler

Для ускорения процесса обработки применяется многозадачность. Запускаются фоновые процессы, количество которых можно установить в конфиге. Чем больше задач, тем меньше нужно времени, но тем больше нужно памяти. Для текущей задания оптимальное количество - 35

Для экономии памяти формируются временные файлы, которые удаляются по завершению процессов.






