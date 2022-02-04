export function ajaxGetAllUsersTableDataFromDb(){
    return $.ajax({
        url: 'loaderUserData.php',
        type: 'post',
        data: {loadData: 'all'},
        dataType: 'json',
        success: function (returnValue){
            usersJson = returnValue;
        }
    })
}

export function ajaxUpdateUserTableValuesInDb(id, name, username, email){
    return $.ajax({
        url: 'handlerUserData.php',
        type: 'post',
        dataType: 'text',
        data: {
            backendAction: 'updateUserValues',
            id: id,
            name: name,
            username: username,
            email: email
        }
    })
}

export function ajaxDeleteRowsFromDb(userTableId, addressTableId, companyTableId){

    return $.ajax({
        url: 'handlerUserData.php',
        type: 'post',
        dataType: 'text',
        data: {
            backendAction: 'deleteRowsById',
            userTableId: userTableId,
            addressTableId: addressTableId,
            companyTableId: companyTableId
        }
    })
}
export function ajaxAddUserToDb(){
    return $.ajax({
        url: 'handlerUserData.php',
        type: 'post',
        dataType: 'text',
        data: {
            backendAction: 'addUser',
            name: $('#name').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            website: $('#website').val(),
            addressStreet: $('#addressStreet').val(),
            addressSuite: $('#addressSuite').val(),
            addressCity: $('#addressCity').val(),
            addressZipcode: $('#addressZipcode').val(),
            addressGeoLat: $('#addressGeoLat').val(),
            addressGeoLang: $('#addressGeoLang').val(),
            companyName: $('#companyName').val(),
            companyCatch: $('#companyCatch').val(),
            companyBs: $('#companyBs').val()
        }
    })
}
export function getSpecificUserDataFromDb(id){
    return $.ajax({
        url: 'loaderUserData.php',
        type: 'post',
        dataType: 'json',
        data: {
            loadData: 'allTablesOneUser',
            id: id,
        },
        success: function (returnData){
            specificUserJson = returnData;
        }
    })
}