import {
    ajaxUploadImageData,
    ajaxLoadImageDataFromDb,
    ajaxInsertImageIntoFolder,
    ajaxDeleteImage,
    ajaxUploadFolderData} from "./modules/ajaxPhotoBackendRequests.js";
import {
    renderFolders,
    placeImages,
    updateAndRender,
    renderAllFolders
} from "./modules/renderDataForPhotoPageFunctions.js";
import {clickOnDivOnBody} from "./modules/displayFunctions.js";

window.dataArray = [];
window.foldersPrev = [];
window.foldersNext = [];
window.foldersAll = [];
window.allImagesSize = 0;
window.recursionOnce = false;
window.currentLocation = 'uploads/' + globalSessionId + '/';


//TODO review cookies logic
// if (!getCookie('currentLocation')){
//     document.cookie = 'currentLocation=root-1';
// }
// if (!getCookie('nextFolderCount')){
//     document.cookie = 'nextFolderCount=1';
// }

$(document).ready(function (){
    clickOnDivOnBody('#actionIcon1', '#upload');
    clickOnDivOnBody('#actionIcon2', '#addFolder');
    clickOnDivOnBody('#actionIcon3', '#insertImage');


    $.when(ajaxLoadImageDataFromDb()).done(function (){
        //TODO ar taip galima? Be reikalo rederinasi folderiai
        renderAllFolders();
        renderFolders();
        placeImages();
    })

    $('#uploadImages').on('click', function() {
        $.when(ajaxUploadImageData()).done(function () {
           updateAndRender();
        })
    });



    $('#addFolder').click(function (){
        var folderName = $('#folderName').val();
        if (folderName !== ''){
            $.when(ajaxUploadFolderData()).done(function () {
                updateAndRender();
            })
        }
    })

    $('#actionIcon4').click(function (){
        $.when(ajaxDeleteImage()).done(function () {
            $.when(ajaxLoadImageDataFromDb()).done(function (){
                placeImages(dataArray);
            })
        })
    });
    $('#insertIntoFolder').click(function () {
        var folderName = $('#displayForFolders').val();
        $.when(ajaxInsertImageIntoFolder(folderName)).done(function (){
            updateAndRender();
        });

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
