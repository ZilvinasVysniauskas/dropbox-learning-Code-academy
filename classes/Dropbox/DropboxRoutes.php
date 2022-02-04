<?php

namespace Dropbox;

use Common\Authentication;
use Common\DatabaseTable;

class DropboxRoutes
{
    private $userImgTable;
    private $foldersTable;
    private $userTable;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';
        $this->userImgTable = new DatabaseTable($pdo, 'userImages', 'id');
        $this->foldersTable = new DatabaseTable($pdo, 'folders', 'id');
        $this->userTable = new DatabaseTable($pdo, 'users', 'username');
    }
    public function getRoutes(){
        $mainPagesController = new Controllers\MainPagesController();
        $authentication = new Authentication($this->userTable, 'username', 'password');
        $loginController = new Controllers\loginController($authentication, $this->userTable);
        if ($authentication->isLogged()){
            $routes = [
                '' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displayPhotosPage'
                    ]
                ],
                'files' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displayFilesPage'
                    ]
                ],
                'sharing' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displaySharingPage'
                    ]
                ],
                'users' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displayUsersPage'
                    ]
                ],
                'links' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displayLinksPage'
                    ]
                ],
                'events' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displayEventsPage'
                    ]
                ],
                'getstarted' => [
                    'GET' => [
                        'controller' => $mainPagesController,
                        'action' => 'displayGetStartedPage'
                    ]
                ],
                'logout' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'logout'
                    ]
                ]

            ];
        }
        else {
            $routes = [
                '' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'login'
                    ],
                    'POST' => [
                        'controller' => $loginController,
                        'action' => 'login'
                    ],

                ],
                'register' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'register'
                    ],
                    'POST' => [
                        'controller' => $loginController,
                        'action' => 'register'
                    ]
                ]
            ];
        }

        return $routes;
    }
}
