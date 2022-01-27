//error when placed after place images function
$(window).click(function(ev){
    if (!document.getElementById('upload').contains(ev.target)){
        $('#upload').css("display", "none");
    }
});
$(".actionIcon1").click(function(ev){
    $('#upload').css("display", "flex");
    ev.stopPropagation();
})

function fetchAndRender(){
    fetch('../js/data.json')
        .then((response) => response.json())
        .then((data) => placeImages(data));
}


$('.actionIcon4').click(function (){
    var elements = $('.marked');
    let arr = [];
    for (let i = 0; i < elements.length; i++) {
        arr.push(elements[i].id)
    }
    $.post('post2.php', {
        arrToDelete: arr
    });
    fetchAndRender();
});
function addClass(id){
    alert(id)
}

function placeImages(arr, sort = null){
    let html = '';
    let size = 0;
    document.getElementById('photoDiv').innerHTML = '';
    for (const [key, value] of Object.entries(arr)){
        console.log(key);
        size += parseFloat(value['imgSize'] / 1048576);
        const colDiv = document.createElement('div');
        colDiv.setAttribute('class', 'col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 text-center')
        const renderedImg = document.createElement('div');
        renderedImg.setAttribute('class', 'renderedImg');
        renderedImg.setAttribute('id', key);
        const img = document.createElement('img');
        img.setAttribute('src', value['imgPath']);
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
        const text1 = document.createTextNode(value['imgName']);
        const text2 = document.createTextNode((value['imgSize'] / 1048576).toFixed(2) + ' mb');
        pName.appendChild(text1);
        pSize.appendChild(text2);

        renderedImg.addEventListener('click', function () {
            document.getElementById(key).classList.toggle('marked');
        })
        document.getElementById('photoDiv').appendChild(colDiv);
    }
    $('#scoreNumber').html(size.toFixed(2));
    let percentage = (size / 30 * 100);
    $('#insideScore').css("width", percentage + '%')
}
fetchAndRender();


