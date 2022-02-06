import {getCookie} from "./renderDataForPhotoPageFunctions.js";




export function ajaxLoadFolderDataFromDb(updateThisFolder = 'all', doAction = 'all'){
    return $.ajax({
        url: 'loader.php',
        dataType: 'json',
        type: 'post',
        data: {loadFoldersBy: currentLocation, action: doAction},
        success:function (returnValue){
            if (updateThisFolder === 'foldersNext'){
                foldersNext = returnValue;
            }
            else if (updateThisFolder === 'foldersPrev') {
                foldersPrev = returnValue;
            }
            else {
                folders = returnValue;
            }
        }
    })
}



