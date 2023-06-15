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
    document.getElementById("tab-title").innerHTML = tabName;
    closeDim()
    closeSideBar()
}

function uploadLoading() {
    document.getElementById("upload-file").style.display = "none";
    document.getElementById("upload-loading").style.display = "block"
}

function copyThisText(text) {
    navigator.clipboard.writeText(text);
    alert("Copied the Code");
}


function toast(message, position, gravity){

  Toastify({

    text: message,
    gravity: gravity, // `top` or `bottom`
    position: position, // `left`, `center` or `right`
    duration: 3000,
    offset: {
      x: 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
      y: 70 // vertical axis - can be a number or a string indicating unity. eg: '2em'
    },
    close: true,
    style: {
      background: "#0B8043",
    },
    maxToasts: 1
    }).showToast();
}

//jquery

$('#upload-button').on("click",()=>{
    if(document.getElementById("file-input").files.length != 0 ){
        document.getElementById('upload-file').style.display = "none";
        document.getElementById('upload-loading').style.display = "block";
    }else{

    }
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



$.ajax({
  url: './php/graphs.php?q=fileTypes',
  type: 'GET',
  dataType: 'json',
  success: function(data) {
    
    var labels = [];
    var values = [];
    var backgroundColors = [];
    var hoverBackgroundColors = [];
    
    // loop through the data and extract the labels and values
    for (var i = 0; i < data.length; i++) {
      labels.push(data[i].label);
      values.push(data[i].value);
      backgroundColors.push(getRandomColor());
      hoverBackgroundColors.push(getRandomColor());
    }
    /*
    // create the pie chart
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: backgroundColors,
          hoverBackgroundColor: hoverBackgroundColors
        }]
      },
      options: {
        responsive: true
      }
    });
    */


  },
  error: function(xhr, status, error) {
    //console.log(error);
  }
});

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function selectRole(role) {
  const white = document.querySelector('.white-background');
  white.classList.add('animateExpand');

  var id = role + "-selection";
  var icon = id  + "-icon";
  var element = document.getElementById(icon)
  element.classList.add('animateCenter')

  var roleInput = document.getElementById("role-input")
  roleInput.value = role
  setTimeout(function(){  document.getElementById("guestForm").submit()}, 3000)
}

function removeCookies() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../php/testRefresh.php', true);
  xhr.send();
  location.reload();
}


