$(function() {
    $("#floatingnav img").mousedown(function () {
        $(this).fadeTo( "fast", 1, function() { return true; });
    }).mouseup(function () {
        $(this).fadeTo( "fast", 0.6, function() { return true; });
    }).mouseout(function () {
        $(this).fadeTo( "fast", 0.6, function() { return true; });
    });
});
