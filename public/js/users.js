import {renderData} from "./modules/renderUsersFunctions.js";
import {ajaxAddUserToDb, ajaxGetAllUsersTableDataFromDb} from './modules/ajaxUsersTable.js'
window.usersJson = [];
window.specificUserJson = [];

$(document).ready( function (){
    $.when(ajaxGetAllUsersTableDataFromDb()).done(function (){
        renderData(usersJson);
    })
    $('#addUserButton').click(function (){
        $('#addUserDisplay').css('display', 'block');
    })
    $('#closeUserDisplay').click(function (){
        $('#addUserDisplay').css('display', 'none');
    })
    $('#closeDisplayAllData').click(function (){
        $('#displayAllData').css('display', 'none');
    })
    $('#saveNewUser').click(function (){
        //TODO avoid empty upload.
        $.when(ajaxAddUserToDb()).done(function (){
            $.when(ajaxGetAllUsersTableDataFromDb()).done(function (){
                renderData(usersJson);
            })
        })

    })
})
