import {ajaxLoadImageDataFromDb} from "./ajaxPhotoBackendRequests.js";

export function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
export function renderAllFolders() {
    document.getElementById('displayForFolders').innerHTML = '';
        foldersAll.forEach(element => {
        const option = document.createElement('option');
        var folderName = element.split('/');
        const name = document.createTextNode(folderName[folderName.length - 1]);
        option.setAttribute('value', element);
        option.appendChild(name);
        document.getElementById('displayForFolders').appendChild(option);
    })
}

export function updateAndRender(){
    $.when(ajaxLoadImageDataFromDb()).done(function () {
        renderAllFolders()
        renderFolders();
        placeImages();
        console.log(foldersPrev);
        console.log(currentLocation);
    })
}
export function renderFolders(){
    document.getElementById('pathDiv').innerHTML = '';
    document.getElementById('folderDiv').innerHTML = '';
    foldersPrev.forEach(element => {
        const folderName = document.createElement('p');
        folderName.setAttribute('class', 'pathPart')
        var name = element.split('/');
        if (name[name.length - 2] === globalSessionId){
            const text = document.createTextNode('home');
            folderName.appendChild(text);
        }
        else{
            let newName = name[name.length - 2]
            const text = document.createTextNode(newName.substring(0, newName.length - 7));
            folderName.appendChild(text);
        }
        folderName.addEventListener('click', function (){
            currentLocation = element;
            updateAndRender();
        })
        document.getElementById('pathDiv').appendChild(folderName);

    })
    foldersNext.forEach(element=>{
        const folder = document.createElement('div');
        folder.setAttribute('class' , 'folder')
        const name = document.createElement('p');
        const text1 = document.createTextNode(element.substring(0, element.length - 7));
        name.appendChild(text1);
        folder.appendChild(name);
        folder.addEventListener('click', function () {
            console.log('clicked On folder')
            currentLocation = currentLocation + element + '/';
            console.log(currentLocation);
            updateAndRender()
        });
        document.getElementById('folderDiv').appendChild(folder);
    })
}
export function placeImages(){
    let size = 0;
    document.getElementById('photoDiv').innerHTML = '';
    dataArray.forEach(element => {
        size += parseFloat(element['imgSize'] / 1048576);
        const colDiv = document.createElement('div');
        colDiv.setAttribute('class', 'col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 text-center')
        const renderedImg = document.createElement('div');
        renderedImg.setAttribute('class', 'renderedImg');
        renderedImg.setAttribute('id', element['id']);
        const img = document.createElement('img');
        img.setAttribute('src', currentLocation +  '/' + element['id']);
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
    allImagesSize = allImagesSize / 1048576;
    $('#scoreNumber').html(allImagesSize.toFixed(2));
    let percentage = (allImagesSize);
    $('#insideScore').css("width", percentage + '%')
}
