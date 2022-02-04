import {ajaxLoadImageDataFromDb} from "./ajaxImage.js";
import {ajaxLoadFolderDataFromDb} from "./ajaxFolder.js";

export function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

export function updateNextFolderAndRender(id){
    document.cookie = "currentLocation=" + id;
    currentLocation = getCookie('currentLocation');
    $.when(ajaxLoadImageDataFromDb()).done(function () {
        $.when(ajaxLoadFolderDataFromDb('foldersNext',
            'updateFoldersNext'), ajaxLoadFolderDataFromDb('foldersPrev',
            'updateFoldersPrev')).done(function () {
            renderFolders();
            placeImages(dataArray);
        })
    })
}


export function displayAllFolderOptions(){
    var place = document.getElementById('displayForFolders');
    $.when(ajaxLoadFolderDataFromDb()).done(function () {
        folders.forEach(element =>{
            const name = document.createElement('option');
            name.setAttribute('value', element['id']);
            const text = document.createTextNode(element['folderName']);
            name.appendChild(text)
            place.appendChild(name);
        })
    })
}

export function renderFolders(){
    document.getElementById('pathDiv').innerHTML = '';
    document.getElementById('folderDiv').innerHTML = '';
    foldersPrev.forEach(element => {
        const folderName = document.createElement('h2');
        const text = document.createTextNode(element['folderName']);
        folderName.appendChild(text);
        folderName.addEventListener('click', function (){
            updateNextFolderAndRender(element['id']);
        })
        document.getElementById('pathDiv').appendChild(folderName);

    })
    foldersNext.forEach(element=>{
        const folder = document.createElement('div');
        folder.setAttribute('class' , 'folder')
        folder.setAttribute('id' , element['id'])
        const name = document.createElement('p');
        const text1 = document.createTextNode(element['folderName']);
        name.appendChild(text1);
        folder.appendChild(name);
        folder.addEventListener('click', function () {
            updateNextFolderAndRender(element['id'])
        });
        document.getElementById('folderDiv').appendChild(folder);
    })
}
export function placeImages(arr){
    let size = 0;
    console.log(dataArray)
    document.getElementById('photoDiv').innerHTML = '';
    arr.forEach(element => {
        size += parseFloat(element['imgSize'] / 1048576);
        const colDiv = document.createElement('div');
        colDiv.setAttribute('class', 'col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 text-center')
        const renderedImg = document.createElement('div');
        renderedImg.setAttribute('class', 'renderedImg');
        renderedImg.setAttribute('id', element['id']);
        const img = document.createElement('img');
        img.setAttribute('src', 'uploads/' + element['id'] + '.jpg');
        img.setAttribute('class', 'w-100');
        const overlay = document.createElement('div');
        overlay.setAttribute('class', 'overlay');
        const pName = document.createElement('p');
        const pSize = document.createElement('p');
        colDiv.appendChild(renderedImg);
        colDiv.appendChild(pName);
        colDiv.appendChild(pSize);
        renderedImg.appendChild(img);
        renderedImg.appendChild(overlay);
        const text1 = document.createTextNode(element['imgName']);
        const text2 = document.createTextNode((element['imgSize'] / 1048576).toFixed(2) + ' mb');
        pName.appendChild(text1);
        pSize.appendChild(text2);

        renderedImg.addEventListener('click', function () {
            document.getElementById(element['id']).classList.toggle('marked');
        })
        document.getElementById('photoDiv').appendChild(colDiv);
    });
    $('#scoreNumber').html(size.toFixed(2));
    let percentage = (size / 30 * 100);
    $('#insideScore').css("width", percentage + '%')
}
