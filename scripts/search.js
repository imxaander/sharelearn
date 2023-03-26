var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var fileCodeSearchGet = urlParams.get('search');

if (fileCodeSearchGet) {
    document.getElementById("file-code-search-input").value = fileCodeSearchGet
    searchFile()
    openTab("", "Download")
}

function searchFile(){
    document.getElementById("download-footer").innerHTML = `<i class="fa-solid fa-spinner fa-spin-pulse" id="loading-icon-search"></i>`
    var fileSearchCode = document.getElementById("file-code-search-input").value
    history.pushState(null, null, '/?search='+fileSearchCode);
  

    $.ajax({
        type: "POST",
        url: "php/search.php",
        data: {
            file_code: fileSearchCode
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
