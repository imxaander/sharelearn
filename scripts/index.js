console.log("Javascript : Working");
let topText = document.getElementById("top-text-header")

function expandtopText(){
    topText.style.whiteSpace = "nowrap"
}
function collapsetopText(){
    topText.style.whiteSpace = "initial"
    topText.style.height = ""
}

function colOrex(){
    if (topText.style.whiteSpace == "nowrap") {
        collapsetopText()
    }else{
        expandtopText()
    }
}

function openSideBar(){
    document.getElementById("side-nav-bar").style.width = "70%"
    openDim()
}

function closeSideBar(){
    document.getElementById("side-nav-bar").style.width = "0"
    closeDim();
}

function openDim(){
    document.getElementById("dim-pane").style.display = "block"
}

function closeDim(){
    document.getElementById("dim-pane").style.display = "none"
}

function closeFromDim(){
    closeSideBar();
}

function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("tabs");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" tab-selected", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " tab-selected";
}
function uploadLoading() {
    document.getElementById("upload-file").style.display = "none";
    document.getElementById("upload-loading").style.display = "block"
}


//jquery

$('#upload-file').on("submit",()=>{
    console.log("uploading...");
    $('#upload-file').style.display = "none";
    $('#upload-loading').style.display = "block";
    
})
$('#copy-id-button').on('click', ()=>{
      // Get the text field
  var copyText = document.getElementById("code-input");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
  // Alert the copied text
  alert("Copied the Code");
})