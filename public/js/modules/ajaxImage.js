export function ajaxUploadImageData(){
    var form_data = new FormData();
    var totalItems = document.getElementById('file').files.length;
    for (let index = 0; index < totalItems; index++){
        form_data.append('files[]', document.getElementById('file').files[index]);
    }
    return $.ajax({
        url: 'handler.php', // <-- point to server-side PHP script
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post'
    });
}

export function ajaxLoadImageDataFromDb(){
    return $.ajax({
        url: 'loader.php',
        dataType: 'json',
        type: 'post',
        data: {loadImages: currentLocation},
        success:function (returnValue){
            dataArray = returnValue;
        }
    })
}
export function ajaxInsertImageIntoFolder(folder){
    let markedItems = $('.marked');
    let arr = [];
    for (let i = 0; i < markedItems.length; i++){
        arr.push(markedItems[i].id)
    }
    return $.ajax({
        url: 'handler.php',
        dataType: 'text',
        type: 'post',
        data: {placeInFolder: arr, folder: folder}
    })
}

export function ajaxDeleteImage(){
    let elements = $('.marked');
    let arr = [];
    for (let i = 0; i < elements.length; i++) {
        arr.push(elements[i].id)
    }
    return $.post('handler.php', {
        arrToDelete: arr
    });
}
