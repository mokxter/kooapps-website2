$(function() {
     $("#homeHiring").click(function() {
        $("#homeTabContent").attr("class", "absoluteWrapper");
        $("#phTabContent").attr("class", "absoluteWrapper hide");
        $("#twTabContent").attr("class", "absoluteWrapper hide");
        $("#tabContainer > img").attr("src", "assets/hiring/weAreHiringTab.png");
    });
    $("#phHiring").click(function() {
        $("#homeTabContent").attr("class", "absoluteWrapper hide");
        $("#phTabContent").attr("class", "absoluteWrapper");
        $("#twTabContent").attr("class", "absoluteWrapper hide");
        $("#tabContainer > img").attr("src", "assets/hiring/weAreHiringTab-ph.png");
    });
    $("#twHiring").click(function() {
        $("#homeTabContent").attr("class", "absoluteWrapper hide");
        $("#phTabContent").attr("class", "absoluteWrapper hide");
        $("#twTabContent").attr("class", "absoluteWrapper");
        $("#tabContainer > img").attr("src", "assets/hiring/weAreHiringTab-tw.png");
    });
});


