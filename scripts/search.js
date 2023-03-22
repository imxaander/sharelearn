var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var fileCodeSearchGet = urlParams.get('search');

if (fileCodeSearchGet) {
    document.getElementById("file-code-search-input").value = fileCodeSearchGet
    searchFile()
    openTab("", "Download")
}

function searchFile(){
    var fileSearchCode = document.getElementById("file-code-search-input").value
    history.pushState(null, null, '/?search='+fileSearchCode);
  

    $.ajax({
        type: "POST",
        url: "php/search.php",
        data: {
            file_code: fileSearchCode
        },
        success: function(response) {
            console.log(response);
            toast(response, "center", "bottom")
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
