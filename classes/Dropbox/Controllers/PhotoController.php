<?php

namespace Dropbox\Controllers;

use Common\DatabaseTable;

class photoController
{
    private $userImgTable;
    private $foldersTable;

    public function __construct(DatabaseTable $userImgTable, DatabaseTable $foldersTable)
    {
        $this->userImgTable = $userImgTable;
        $this->foldersTable = $foldersTable;

    }

    public function loadImageDataToDb ($postFile){
        $columns = ['id','imgSize', 'imgName'];
        $data = [];
        foreach ($postFile['files']['name'] as $key => $value){
            $id = str_replace('.', '-', uniqid('', true));
            $data[] = [$id, $postFile['files']['size'][$key],
                $postFile['files']['name'][$key]];
            imagejpeg(imagecreatefromstring(file_get_contents($postFile['files']['tmp_name']
            [$key])), 'uploads/' . $id . '.jpg');
        }
        $this->userImgTable->insertMultipleValues($columns, $data);
    }

    public function addFolderIntoDb($postInfo){
        $data = [
            'id' => $postInfo['folderLocation'],
            'folderName' => $postInfo['folderName']
        ];
        $this->foldersTable->insertIntoDb($data);
    }

    public function imageDataFromDbToJson($post = 'null'){
        if ($post === 'null'){
            $result = $this->userImgTable->selectDataFromDb(['folderId' => 'root-1']);
        }
        else{
            $result = $this->userImgTable->selectDataFromDb(['folderId' => $post]);
        }
        $data = [];
        foreach ($result as $key => $value){
            $data[] = [
                'id' => $value['id'],
                'imgSize' => $value['imgSize'],
                'imgName' => $value['imgName'],
                'uploadDate' => $value['date']
            ];
        }
        echo json_encode($data);
    }
    public function folderDataFromDbToJson($load = null, $action = null){
        if ($action === 'updateFoldersNext'){
            $select = ' id like "'. $load .'-%"  and id not like "'.$load.'-%-%"';
            $result = $this->foldersTable->selectDataFromDbCustom('custom', $select);
        }
        else if ($action === 'updateFoldersPrev') {
            $select = [];
            $load = strrev($load);
            while (strrev($load) !== 'root-1'){
                $index = strpos($load, '-');
                $load = substr($load, $index + 1, strlen($load) - 1);
                $select[] = strrev($load);
            }
            $result = $this->foldersTable->selectDataFromDbCustom('inArray', $select, 'id');
        }
        else {
            $result = $this->foldersTable->selectDataFromDb();
        }
        $data = [];
        foreach ($result as $key => $value){
            $data[] = [
                'id' => $value['id'],
                'folderName' => $value['folderName'],
                'date' => $value['date']
            ];
        }
        echo json_encode($data);
    }

}