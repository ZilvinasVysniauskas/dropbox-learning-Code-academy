import {ajaxDeleteRowsFromDb, ajaxGetAllUsersTableDataFromDb, ajaxUpdateUserTableValuesInDb, getSpecificUserDataFromDb}
    from "./ajaxUsersTable.js";

export function renderData(arr) {
    document.getElementById('displayTable').innerHTML = '';
    const table = document.createElement('table');
    table.setAttribute('class', 'w-100')
    let row_1 = document.createElement('tr');
    let heading_1 = document.createElement('th');
    heading_1.innerHTML = 'ID';
    let heading_2 = document.createElement('th');
    heading_2.innerHTML = 'Name';
    let heading_3 = document.createElement('th');
    heading_3.innerHTML = 'User name';
    let heading_4 = document.createElement('th');
    heading_4.innerHTML = 'Email';
    let heading_5 = document.createElement('th');
    heading_5.innerHTML = 'Actions';
    row_1.appendChild(heading_1);
    row_1.appendChild(heading_2);
    row_1.appendChild(heading_3);
    row_1.appendChild(heading_4);
    row_1.appendChild(heading_5);
    table.appendChild(row_1);

    arr.forEach((element, id) => {
        const row = document.createElement('tr');
        table.appendChild(row);
        let number = document.createElement('td');
        number.innerHTML = `${element.id}`;
        row.appendChild(number);
        let name = document.createElement('td');
        name.innerHTML = `${element.name}`;
        row.appendChild(name);
        let userName = document.createElement('td');
        userName.innerHTML = `${element.username}`;
        row.appendChild(userName);
        let email = document.createElement('td');
        email.innerHTML = `${element.email}`;
        row.appendChild(email);
        let icons = document.createElement('td')
        row.appendChild(icons);
        let edit = document.createElement('i')
        edit.setAttribute('class', 'fas fa-edit')
        let displayAll = document.createElement('i');
        displayAll.setAttribute('class', 'fas fa-plus-square')
        let remove = document.createElement('i');
        remove.setAttribute('class', 'fas fa-trash-alt');
        icons.appendChild(edit);
        icons.appendChild(displayAll);
        icons.appendChild(remove);

        const editPopup = document.createElement('div');
        const close = document.createElement('div')
        close.setAttribute('class', 'closeAction')
        editPopup.appendChild(close);
        editPopup.setAttribute('id', 'editPopup');
        const editName = document.createElement('input');
        editName.setAttribute('type', 'text')
        editName.setAttribute('value', element.name)
        editPopup.appendChild(editName);
        const editUsername = document.createElement('input');
        editUsername.setAttribute('type', 'text');
        editUsername.setAttribute('value', element.username);
        editPopup.appendChild(editUsername);
        const editEmail = document.createElement('input');
        editEmail.setAttribute('type', 'text');
        editEmail.setAttribute('value', element.email);
        editPopup.appendChild(editEmail);
        const save = document.createElement('button');
        save.innerHTML = 'save';
        editPopup.appendChild(save);
        table.appendChild(editPopup);


        displayAll.addEventListener('click', function () {
            $.when(getSpecificUserDataFromDb(element.id)).done(function (){
                $('#displayAllData').css('display', 'block')
                $('#nameDisplay').val(specificUserJson.name);
                $('#usernameDisplay').val(specificUserJson.username);
                $('#emailDisplay').val(specificUserJson.email);
                $('#phoneDisplay').val(specificUserJson.phone);
                $('#websiteDisplay').val(specificUserJson.website);
                $('#addressStreetDisplay').val(specificUserJson.street);
                $('#addressSuiteDisplay').val(specificUserJson.suite);
                $('#addressCityDisplay').val(specificUserJson.city);
                $('#addressZipcodeDisplay').val(specificUserJson.zipcode);
                $('#addressGeoLatDisplay').val(specificUserJson.lat);
                $('#addressGeoLngDisplay').val(specificUserJson.lng);
                $('#companyNameDisplay').val(specificUserJson.companyName);
                $('#companyCatchDisplay').val(specificUserJson.catch);
                $('#companyBsDisplay').val(specificUserJson.bs);

            })
        })

        edit.addEventListener('click' , function(){
            editPopup.style.display = 'block';
        })
        close.addEventListener('click', function(){
            editPopup.style.display = 'none';
        })

        save.addEventListener('click', function (){
            Object.keys(usersJson).every( function(key) {
                if (usersJson[key].id === element.id){
                    $.when(ajaxUpdateUserTableValuesInDb(element.id, editName.value,
                        editUsername.value, editEmail.value)).done(function (){
                        $.when(ajaxGetAllUsersTableDataFromDb()).done(function () {
                            renderData(usersJson);
                        })
                    })
                    return false;
                }
                return true
            })
            renderData(usersJson);
        })
        remove.addEventListener('click', function (){
            Object.keys(usersJson).every( function(key) {
                if (usersJson[key].id === element.id){
                    console.log(1)
                    //TODO very slow loads
                    $.when(ajaxDeleteRowsFromDb(element.id, element.addressId, element.companyId)).done(function () {
                            $.when(ajaxGetAllUsersTableDataFromDb()).done(function (){
                                renderData(usersJson);
                            })
                    })
                    return false;
                }
                return true;
            })
        })
    });
    document.getElementById('displayTable').appendChild(table);
}
