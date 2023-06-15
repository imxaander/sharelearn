function openEditWindow(code){
    let id  = code
    let windowStyle = document.getElementById(id).style
    windowStyle.display  = "block";
    openDim();
    
}
function closeEditWindow(code){
    let id  = code
    let windowStyle = document.getElementById(id).style
    windowStyle.display  = "none";
    closeDim()

    const elements = document.querySelectorAll(".uploaded-file-edit");
    for (const element of elements) {
        element.style.display = "none"
    }
}
function copyText(text){
    navigator.clipboard.writeText(text);
    toast("ID has been copied",  'center', 'bottom')
}
function getRootUrl() {
    var location = window.location;
    var pathname = location.pathname;
    var protocol = location.protocol;
    var host = location.host;
    return  host;
  }

function createQR(code, event){
    var location = getRootUrl();
    var qrcode = new QRCode(document.getElementById("qrcode-"+code), {
        width : 200,
        height : 200,
        colorDark : "#0B8043"
    });
    qrcode.makeCode("https://"+location+"?search="+code)
    document.getElementById("generate"+code).remove();
}

function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    var text = decodedText
    var specificString = "https://"+getRootUrl();

    if (text.startsWith(specificString)) {
        window.location.href = text;
    }
}

var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);

function openReader(){
    document.getElementById("reader-wrapper").style.display = "block"
    openDim()
}
function closeReader(){
    document.getElementById("reader-wrapper").style.display = "none"
}

function closeFromDim(){
    closeSideBar();
    closeAllEdit()
    closeReader();
}

function closeAllEdit(){
    const boxes = document.querySelectorAll('.uploaded-file-edit'); 
    boxes.forEach(box => { 
    box.style.display = '';
    });
}