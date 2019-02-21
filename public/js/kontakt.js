$("#contactForm").on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Fyllde ni i alla uppgifter riktigt?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var namn = $("#namn").val();
    var epost = $("#epost").val();
    //var msg_subject = $("#msg_subject").val();
    var msg_subject = "meddelande från kontakt formulär";
    var meddelande = $("#meddelande").val();


    $.ajax({
        type: "POST",
        url: "kontakt/skicka",
        data: "namn=" + namn + "&epost=" + epost + "&msg_subject=" + msg_subject + "&meddelande=" + meddelande,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Meddelandes Mottaget!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}



