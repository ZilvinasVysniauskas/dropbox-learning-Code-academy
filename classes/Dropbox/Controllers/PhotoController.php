<?php

namespace Dropbox\Controllers;

use Common\DatabaseTable;

class photoController
{
    private $userImgTable;
    public $foldersNext = [];
    public $foldersPrev = [];
    public $imageData = [];
    public $foldersAll = [];
    public $foldersAllPath = [];

    public function __construct(DatabaseTable $userImgTable)
    {
        $this->userImgTable = $userImgTable;
    }
    //TODO USED
    public function loadImageDataToDb ($postFile, $location){
        $columns = ['id','imgSize', 'imgName', 'userId'];
        $data = [];
        foreach ($postFile['files']['name'] as $key => $value){
            $idName = str_replace('.', '-', uniqid('', true)) . '.jpg';
            $data[] = [$idName, $postFile['files']['size'][$key],
                $postFile['files']['name'][$key], $_SESSION['id']];
            imagejpeg(imagecreatefromstring(file_get_contents($postFile['files']['tmp_name']
            [$key])), $location . $idName);
        }
        $this->userImgTable->insertMultipleValues($columns, $data);
    }

    public function addFolder($folderName, $location){
        mkdir($location . $folderName . '.folder');
    }

    private function findAllFolders($dir){
        $innerFolderList = [];
        $children = scandir($dir);
        foreach ($children as $part){
            if (substr($part, -6, 7) === 'folder'){
                $innerFolderList[] = $dir . '/' . $part;
            }
        }
        if (!empty($innerFolderList)){
            $this->foldersAll = array_merge($this->foldersAll, $innerFolderList);
            foreach ($innerFolderList as $folder){
                $this->findAllFolders($folder);
            }
        }
    }
    private function getSizeOfAllImages(){
        $condition = ['userId' => $_SESSION['id']];
        $columns = ['SUM(imgSize) as total'];
        return $this->userImgTable->selectDataFromDb($condition, $columns)[0]['total'];

    }

    public function imageDataFromDbToJson($currentLocation){
        $filesInFolder = scandir($currentLocation, 1);
        unset($filesInFolder[array_search('.', $filesInFolder, true)]);
        unset($filesInFolder[array_search('..', $filesInFolder, true)]);
        $rootLocation = 'uploads/' . $_SESSION['id'] . '/';
        $this->findAllFolders($rootLocation);
        $afterRoot = str_replace($rootLocation, '', $currentLocation);
        $list = explode('/',$afterRoot);
        array_pop($list);
        while ($currentLocation !== $rootLocation){
            array_pop($list);
            $currentLocation = $rootLocation;
            foreach ($list as $folder){
                $currentLocation .=  $folder . '/';
            }
            $this->foldersPrev[] = $currentLocation;
        }
        $this->foldersPrev = array_reverse($this->foldersPrev);
        //TODO ar gerai taip atskirinėti folderius?
        foreach ($filesInFolder as $key => $part){
            if (substr($part, -6, 7) === 'folder'){
                $this->foldersNext[] = $part;
            }
            else {
                $this->imageData[] = $part;
            }
        }
        $result = $this->userImgTable->selectDataFromDbCustom('inArray', $this->imageData, 'id');
        $data = [];
        foreach ($result as $key => $value){
            $data[] = [
                'id' => $value['id'],
                'imgSize' => $value['imgSize'],
                'imgName' => $value['imgName'],
                'uploadDate' => $value['date']
            ];
        }
        $jsonObject = [];
        $jsonObject['foldersNext'] = $this->foldersNext;
        $jsonObject['foldersPrev'] = $this->foldersPrev;
        $jsonObject['foldersAll'] = $this->foldersAll;
        $jsonObject['arrayData'] = $data;
        $jsonObject['allImagesSize'] = $this->getSizeOfAllImages();
        echo json_encode($jsonObject);
    }


}