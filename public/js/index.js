import {ajaxLoadFolderDataFromDb, ajaxUploadFolderData} from "./modules/ajaxFolder.js";
import {ajaxUploadImageData, ajaxLoadImageDataFromDb,
    ajaxInsertImageIntoFolder, ajaxDeleteImage} from "./modules/ajaxImage.js";
import {renderFolders, displayAllFolderOptions, getCookie, placeImages} from "./modules/renderPhotoFunctions.js";

window.dataArray = [];
window.foldersPrev = [];
window.foldersNext = [];
window.folders = [];
window.recursionOnce = false;
window.currentLocation = getCookie('currentLocation');


if (!getCookie('currentLocation')){
    document.cookie = 'currentLocation=root-1';
}
if (!getCookie('nextFolderCount')){
    document.cookie = 'nextFolderCount=1';
}





function clickOnDivOnBody(clickOnId, displayId){
    $(window).click(function(ev){
        if (!document.getElementById('upload').contains(ev.target)){
            $(displayId).css("display", "none");
        }
    });
    $(clickOnId).click(function(ev){
        $(displayId).css("display", "flex");
        ev.stopPropagation();
    });
}



$(document).ready(function (){

    displayAllFolderOptions();

    $.when(ajaxLoadFolderDataFromDb('foldersNext','updateFoldersNext'),
        ajaxLoadFolderDataFromDb('foldersPrev','updateFoldersPrev'),
        ajaxLoadImageDataFromDb()).done(function (){
            renderFolders();
            placeImages(dataArray)
    })

    clickOnDivOnBody('#actionIcon1', '#upload');
    $('#uploadImages').on('click', function() {
        $.when(ajaxUploadImageData()).done(function () {
           $.when(ajaxLoadImageDataFromDb()).done(function (){
               placeImages(dataArray);
           })
        })
    });

    clickOnDivOnBody('#actionIcon2', '#addFolder');

    $('#addFolder').click(function (){
        var folderName = $('#folderName').val();
        if (folderName !== ''){
            $.when(ajaxUploadFolderData()).done(function () {
                $.when(ajaxLoadFolderDataFromDb('foldersNext','updateFoldersNext'),
                    ajaxLoadFolderDataFromDb('foldersPrev','updateFoldersPrev')).done(function () {
                    renderFolders();
                })
                })
        }
    })
    clickOnDivOnBody('#actionIcon3', '#insertImage');

    $('#actionIcon4').click(function (){
        $.when(ajaxDeleteImage()).done(function () {
            $.when(ajaxLoadImageDataFromDb()).done(function (){
                placeImages(dataArray);
            })
        })
    });
    $('#insertIntoFolder').click(function () {
        var folderName = $('#displayForFolders').val();
        ajaxInsertImageIntoFolder(folderName);
        $.when(ajaxLoadImageDataFromDb())

    })
    $('#sortSize').click(function (){
        if(!$(this).hasClass('selected')) {
            placeImages(dataArray.sort((a, b) => (parseInt(a.imgSize) < parseInt(b.imgSize)) ? -1 :
                (parseInt(a.imgSize) > parseInt(b.imgSize) ? 1 : 0)));
        }
        else {
            placeImages(dataArray.sort((a, b) => (parseInt(a.imgSize) < parseInt(b.imgSize)) ? 1 :
                (parseInt(a.imgSize) > parseInt(b.imgSize) ? -1 : 0)));
        }
        $(this).toggleClass('selected')
    })
    $('#sortDate').click(function (){
        if(!$(this).hasClass('selected')) {
            placeImages(dataArray.sort((a, b) => ((new Date(a.uploadDate).getTime()/1000) < (new Date(b.uploadDate).getTime()/1000)) ? -1 :
                ((new Date(a.uploadDate).getTime()/1000) > (new Date(b.uploadDate).getTime()/1000) ? 1 : 0)));
        }
        else {
            placeImages(dataArray.sort((a, b) => ((new Date(a.uploadDate).getTime()/1000) < (new Date(b.uploadDate).getTime()/1000)) ? 1 :
                ((new Date(a.uploadDate).getTime()/1000) > (new Date(b.uploadDate).getTime()/1000) ? -1 : 0)));
        }
        $(this).toggleClass('selected')
    })
    $('#sortName').click(function (){
        if(!$(this).hasClass('selected')) {
            placeImages(dataArray.sort((a, b) => ((a.imgName) < (b.imgName)) ? -1 :
                ((a.imgName) > (b.imgName) ? 1 : 0)));
        }
        else {
            placeImages(dataArray.sort((a, b) => ((a.imgName) < (b.imgName)) ? 1 :
                ((a.imgName) > (b.imgName) ? -1 : 0)));
        }
        $(this).toggleClass('selected')
    })

    $("#searchForImage").keyup(function(event) {
        if (event.keyCode === 13) {
            const val = $(this).val();
            let searchedArray = [];
            if (val !== ''){
                dataArray.forEach(element=>{
                    if(element['imgName'].toUpperCase().startsWith(val.toUpperCase())){
                        searchedArray.push(element);
                    }
                })
                $(this).val('');
                placeImages(searchedArray);
            }
        }
    });
});
