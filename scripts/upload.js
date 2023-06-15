//for  multiple uploads
  // get elements from DOM
  const fileInput = document.getElementById("fileInput");

  const uploadBtn = document.getElementById("uploadBtn");
  const fileList = document.getElementById("fileList");

  // array to store selected files
  let selectedFiles = [];

  // add event listeners to buttons
  uploadBtn.addEventListener("click", uploadFiles);
  fileInput.addEventListener("change", addFilesToList);

  // function to add selected files to list and array
  function addFilesToList() {
  const files = fileInput.files;
  for (let i = 0; i < files.length; i++) {
      const div = document.createElement("div");
      div.className = "added-item-uploads";
      let icon = getIconForUpload(files[i].name.split(".").pop());
      let fname = shortenFilename(files[i].name, 30);
      div.innerHTML = `<i class="fa-solid fa-file${icon} added-item-icon"></i><p class="file-name-uploads">${fname}</p> <a href="#" class="removeBtn" data-name="${files[i].name}" >&#10006</a>`;
      fileList.appendChild(div);
      selectedFiles.push(files[i]);

    }

    // add event listeners to remove buttons
    const removeBtns = document.querySelectorAll(".removeBtn");
    removeBtns.forEach(btn => btn.addEventListener("click", removeFileFromList));
  }

  // function to remove file from list and array
  function removeFileFromList(event) {

  const index = selectedFiles.findIndex(file => file.name === event.target.parentElement.lastChild.getAttribute('data-name'));
  //selectedFiles.indexOf(String(event.target.parentElement.lastChild.getAttribute('data-name')));
  let name = event.target.parentElement.lastChild.getAttribute('data-name')
  var fileInput = document.getElementById('fileInput');
    fileInput.value = "";
  if (index !== -1) {
      selectedFiles.splice(index, 1);
  }
  event.target.parentElement.remove();

  }


  // function to upload selected files
  function uploadFiles() {
    let form = new FormData();
    for (let i = 0; i < selectedFiles.length; i++) {
        form.append('file[]', selectedFiles[i]);
    }

  // submit form data to server

  fetch('php/testUpload.php', {
      method: 'POST',
      body: form
  }).then(function(response) {
    if (response.status >= 200 && response.status < 300) {
        return response.text()
    }
        throw new Error(response.statusText)
    })
    .then(function(response) {
        // clear file list and array
        fileList.innerHTML = '';
        toast(response, "center", "top");
        selectedFiles = [];
    })
  }
  function shortenFilename(filename, maxLength) {
    let extension = filename.split('.').pop(); // get the extension of the filename
    let name = filename.substr(0, filename.length - extension.length - 1); // get the name of the file without the extension
    let shortName = name.substr(0, maxLength) + '...'; // shorten the name of the file and add ellipsis
    return shortName + extension; // combine the shortened name and the extension to form the new filename
  }
  
function getIconForUpload(fileformat){

    switch (fileformat) {
        case "mp3":
        case "ogg":
        case "wav":
            return "-audio";
            break;
        case "docx":
        case "doc":
            return "-word"
            break;
        case "ppt":
        case "pptx":
            return "-powerpoint";
            break;
        case "xlsx":
        case "xlsm":
        case "xlsb":
        case "xltm":
        case "xltm":
            return "-excel";
            break;
        default:
            return "";
            break;
    }
}
console.log(getRootUrl())