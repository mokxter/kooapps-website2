$(document).ready(function() {
    $("form").submit(function() {
        var name = $("#inputName").val();
        var email = $("#inputEmail").val();
        var subject = $("#inputSubject").val();
        var comment = $("#inputComment").val();

        if (name == '' || email == '' || subject == '' || comment == '') {
            alert("Some fields are blank. Please fill out the form.");
        } else {
            $.post("mail.php", { inputName: name, inputEmail: email, inputSubject: subject, inputComment: comment}, function(data) {
                if (data) {
                    alert("Comment successfully sent!");
                    $("form")[0].reset();
                } else {
                    alert("Comment unsuccessfully sent.");
                }
            });
        }

        return false;
    });
});
