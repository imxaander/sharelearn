function nav(ch){
    let val = ""
    if (ch) {
        val = "block"
    }else{
        val = "none"
    }
    document.getElementById("action-select-access").style.display = val;
}
function login(ch){
    let val = ""
    if (ch) {
        val = "block"
    }else{
        val = "none"
    }
    document.getElementById("login-form").style.display = val;
}

function signup(ch){
    let val = ""
    if (ch) {
        val = "block"
    }else{
        val = "none"
    }
    document.getElementById("register-form").style.display = val;
}
function openSign(){
    signup(true)
    nav(false)
    rHeight()
}
function openLog(){
    login(true)
    nav(false)
    rHeight()
}
function goBack(){
    login(false)
    signup(false)
    nav(true)
    rHeight()
}

function rHeight() {
}
var gsList  = ["TVL ALLEN",
                    "TVL PRADA",
                    "",
                ]
function initiateGS(){

}
function continueAsGuest(){
    window.history.back()
  }

console.log("access.js");