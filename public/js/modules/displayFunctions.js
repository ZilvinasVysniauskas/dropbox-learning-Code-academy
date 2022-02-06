export function clickOnDivOnBody(clickOnId, displayId){
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