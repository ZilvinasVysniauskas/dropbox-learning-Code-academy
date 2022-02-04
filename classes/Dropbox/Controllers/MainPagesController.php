<?php
namespace Dropbox\Controllers;

class MainPagesController
{
    public function displayPhotosPage(){
        return [
            'title' => 'photos',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'photosDisplay.html.php']
            ]
        ];
    }

    public function displayFilesPage(){
        return [
            'title' => 'displayFilesPage',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'displayFilesPage.html.php']
            ]
        ];
    }

    public function displaySharingPage(){
        return [
            'title' => 'sharing',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'displaySharingPage.html.php']
            ]
        ];
    }

    public function displayLinksPage(){
        return [
            'title' => 'links',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'displayLinksPage.html.php']
            ]
        ];
    }

    public function displayEventsPage(){
        return [
            'title' => 'Events',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'displayEventsPage.html.php']
            ]
        ];
    }

    public function displayGetStartedPage(){
        return [
            'title' => 'Get Started',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'displayGetStartedPage.html.php']
            ]
        ];
    }

    public function displayUsersPage(){
        return [
            'title' => 'Get Started',
            'templates' => [
                'logged' => ['template' => 'loggedMenu.html.php'],
                'search' => ['template' => 'topSearchDisplay.html.php', 'variables' => ['name' => $_SESSION['username']]],
                'output' => ['template' => 'displayUsersPage.html.php']
            ]
        ];
    }
}