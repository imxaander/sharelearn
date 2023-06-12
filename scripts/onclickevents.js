function openEditWindow(code){
    let id  = code
    let windowStyle = document.getElementById(id).style
    windowStyle.display  = "block";
    
}
function closeEditWindow(code){
    let id  = code
    let windowStyle = document.getElementById(id).style
    windowStyle.display  = "none";

    const elements = document.querySelectorAll(".uploaded-file-edit");
    for (const element of elements) {
        element.style.display = "none"
    }
}
function copyText(text){
    navigator.clipboard.writeText(text);
    toast("ID has been copied",  'center', 'bottom')
}

function createQR(code, event){
    var location = "192.168.1.9";
    var qrcode = new QRCode(document.getElementById("qrcode-"+code), {
        width : 200,
        height : 200,
        colorDark : "#0B8043"
    });
    qrcode.makeCode("http://"+location+"?search="+code)
    document.getElementById("generate"+code).remove();
}