$(function() {
    var contents = $("#faqsTextContainer").children();
    for ( var y = 0; y < contents.length; y++ ) {
        if ( y == 0 ) contents[y].setAttribute("class", "faqsScrollContainer");
        else contents[y].setAttribute("class", "faqsScrollContainer hide");
    }

    var tabs = $("#appIcons").children();
    for ( var y = 0; y < tabs.length; y++ ) {
        if ( y == 0 ) tabs[y].setAttribute("class", "appTab activeFaq");
        else tabs[y].setAttribute("class", "appTab inactiveFaq");
        //tabs[y].on("click", showTab);
        tabs[y].onclick = showTab;
    }
});


function showTab () {
    var id = this.id.slice(0, -3);

    var contents = $("#faqsTextContainer").children();
    for ( var y = 0; y < contents.length; y++ ) {
        if ( contents[y].id == id + "Content" ) contents[y].setAttribute("class", "faqsScrollContainer");
        else contents[y].setAttribute("class", "faqsScrollContainer hide");
    }

    var tabs = $("#appIcons").children();
    for ( var y = 0; y < tabs.length; y++ ) {
        if ( tabs[y].id == id + "Tab" ) tabs[y].setAttribute("class", "appTab activeFaq");
        else tabs[y].setAttribute("class", "appTab inactiveFaq");
    }

}
