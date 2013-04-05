<?php

$emails = json_decode(file_get_contents(__DIR__ . '/../cache/database.json'), true);
include __DIR__ . '/views/index.view.php';
