$(document).ready(function() {
    $("btnSendContactAgentMessage").click((event) => {
        event.preventDefault();
        alert("Sending information...");
        //Ajax recuest...
        const fromData = {
            "name": $("#name").val(),
            "email": $("#email").val(),
            "phone": $("#phone").val(),
            "message": $("#message").val(),
            "property_id": $("property_id").val()
        }
        $.ajax({
            url:"api/contact_agent",
            type: "post",
            data : fromData,
            succes:(response)=>{
                $("#fromContactAgent").trigger("reset");
                $("successAlert").removeClass("d-none");
                setTimeout(() => {
                    //$("successAlert").addClasss
                };
                //alert("Contact Agent message has been sent...")
            },
            error: (errors)=>sx{
                console.error(errors);
            }
        });
    });
});
