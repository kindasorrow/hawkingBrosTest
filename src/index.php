<?php
require_once './Models/Hawking.php';
require_once './Models/FilesFinder.php';

use Models\FilesFinder;
use Models\Hawking;

// Ex #1
$hawking = new Hawking();
$data = $hawking->production();

// Ex #3
$files = FilesFinder::find();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Hawking Bros Test</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Hawking Bros Test</h1>
    <i>by <a href="https://github.com/kindasorrow">kindasorrow</a></i>
</div>
<div class="container mt-5">
    <h2>Задача №1</h2>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                        Открыть / Закрыть
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Script Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (array_slice($data, 0, 100) as $row) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['script_name']}</td>";
                            echo "<td>".date('Y-m-d H:i:s', $row['start_time'])."</td>";
                            echo "<td>".date('Y-m-d H:i:s', $row['end_time'])."</td>";
                            echo "<td>{$row['result']}</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2>Задача №2</h2>
    <div id="accordion2">
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                            aria-controls="collapseOne">
                        Открыть / Закрыть
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                <div class="card-body">
                    <div class="pre-scrollable">
                        <pre>
<span style="background-color:#f1b7b7">select * from data,link,info where link.info_id = info.id and link.data_id = data.id</span>
<span style="background-color:#a2efb3">
SELECT info.id AS info_id, info.name AS info_name, info.desc AS info_desc,
data.id AS data_id, data.date AS data_date, data.value AS data_value
FROM link
JOIN info ON link.info_id = info.id
JOIN data ON link.data_id = data.id;</span>

CREATE TABLE `info` (
    `id` int(11) NOT NULL auto_increment,
    `name` varchar(255) <span style="background-color:#f1b7b7">default NULL</span>,
    `desc` text <span style="background-color:#f1b7b7">default NULL</span>,
    PRIMARY KEY (`id`)
) <span style="background-color:#f1b7b7">ENGINE=MyISAM DEFAULT CHARSET=cp1251;</span> <span
                                    style="background-color:#a2efb3">ENGINE=InnoDB DEFAULT CHARSET=cp1251;</span>

CREATE TABLE `data` (
    `id` int(11) NOT NULL auto_increment,
    `date` date <span style="background-color:#f1b7b7">default NULL</span>,
    `value` INT(11) <span style="background-color:#f1b7b7">default NULL</span>,
    PRIMARY KEY (`id`)
) <span style="background-color:#f1b7b7">ENGINE=MyISAM DEFAULT CHARSET=cp1251;</span> <span
                                    style="background-color:#a2efb3">ENGINE=InnoDB DEFAULT CHARSET=cp1251;</span>

CREATE TABLE `link` (
    `data_id` int(11) NOT NULL,
    `info_id` int(11) NOT NULL
    <span style="background-color:#a2efb3">FOREIGN KEY (`data_id`) REFERENCES `data` (`id`),</span>
    <span style="background-color:#a2efb3">FOREIGN KEY (`info_id`) REFERENCES `info` (`id`)</span>
) <span style="background-color:#f1b7b7">ENGINE=MyISAM DEFAULT CHARSET=cp1251;</span> <span
                                    style="background-color:#a2efb3">ENGINE=InnoDB DEFAULT CHARSET=cp1251;</span>

<span style="background-color:#a2efb3">ALTER TABLE link ADD INDEX info_id_index (info_id);</span>
<span style="background-color:#a2efb3">ALTER TABLE link ADD INDEX data_id_index (data_id);</span>
                            </pre>
                    </div>
                    <div class="container mt-2">
                        <h4>Комментарии</h4>
                        <ol class="list-group list-group-flush">
                            <li class="list-group-item">Использование JOIN вместо объединения таблиц — более читаемый и
                                стандартный способ написания запросов, который также обычно обеспечивает лучшую
                                производительность
                            </li>
                            <li class="list-group-item">Исключение дулбирования info.id и data.id в запросе</li>
                            <li class="list-group-item">Удаление default NULL из столбцов, т.к. это писать излишне</li>
                            <li class="list-group-item">Использование движка InnoDB вместо MyISAM (улучшенная
                                безопасность, высокая скорость)
                            </li>
                            <li class="list-group-item">Добавление внешних ключей</li>
                            <li class="list-group-item">Создание индексов для ускорения поиска в таблицах</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h2>Задача №3</h2>
    <div id="accordion3">
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                        Открыть / Закрыть
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion3">
                <div class="card-body">
                    <ol class="list-group list-group-flush">
                        <?php
                        foreach (array_slice($files, 0, 100) as $row) {
                            echo "<li class='list-group-item text-center'>$row</li>";
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <a href="ТЗ.docx" download>
        <button type="button" class="btn btn-light btn-lg btn-block">Скачать ТЗ</button>
    </a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
