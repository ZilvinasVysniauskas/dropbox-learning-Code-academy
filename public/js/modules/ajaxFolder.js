import {getCookie} from "./renderPhotoFunctions.js";



export function ajaxUploadFolderData(){
    let folderName = $('#folderName');
    let nextFolderCount = parseInt(getCookie('nextFolderCount'));
    let currentFolderLocation = getCookie('currentLocation');
    let location = currentFolderLocation + '-' + nextFolderCount;
    document.cookie = "nextFolderCount=" + (nextFolderCount + 1);
    return $.ajax({
        url: 'handler.php',
        dataType: 'text',
        type: 'post',
        data: {
            folderName:  folderName.val(),
            folderLocation: location
        }
    })
}
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



