function openEditWindow(code){
    let id  = code
    let windowStyle = document.getElementById(id).style
    windowStyle.display  = "block";
    
}
function closeEditWindow(code){
    let id  = code
    let windowStyle = document.getElementById(id).style
    windowStyle.display  = "none";
}