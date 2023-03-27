function downloadFile(code){
    $.ajax({
        type: "POST",
        url: "php/download.php",
        data: {
            "file-code": code
        },
        success: function(response) {
            if (response == "no file") {
                toast("No file associated with the file code.", "center", "bottom")
                $("#download-footer").html("")
            }else if(response == "no code"){
                toast("No code inserted.", "center", "bottom")
                $("#download-footer").html("")
            }else{
                $("#download-footer").html(response)
            }
        },
        error: function(xhr, status, error) {
            toast("There's an error in searching.")
            console.log("Request failed!");
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
}
