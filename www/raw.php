<?php

if (isset($_GET['id'])) {
    if (file_exists('../cache/raw-' . $_GET['id'] . '.txt')) {
        echo '<pre>' . file_get_contents('../cache/raw-' . $_GET['id'] . '.txt') . '</pre>';
    }
}
