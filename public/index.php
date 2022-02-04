<?php
try {
    include __DIR__ . '/../includes/autoload.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $entryPoint = new \Common\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Dropbox\DropboxRoutes());
    $entryPoint->run();
}
catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
    include __DIR__ . '/../templates/mainLayout.html.php';
}