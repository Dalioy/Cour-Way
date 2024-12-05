const form = document.querySelector("form"),
fileInput = form.querySelector(".file-input"),
progressArea = document.querySelector(".progress-area"),
uploadedArea = document.querySelector(".uploading_area");

form.addEventListener("click", ()=>{
    fileInput.click();
});

fileInput.onchange = ({target}) =>{
    // getting file and [0] this means if user has selected multiple files then get first one only
    let file = target.files[0];
    if(file){
        let fileName = file.name;
        if(fileName.length >= 12){
            let splitName = fileName.split('.');
            fileName = splitName[0].substring(0,12) + "... ."+splitName[1];
        }
        uploadFile(fileName); // calling uploadFile with passing file name as an argument
    }
}

function uploadFile(name){
    let xhr = new XMLHttpRequest(); // creating new xml obj (ajax)
    xhr.open("POST","Modifier.php"); //sending post request to the specified URL/File 
    xhr.upload.addEventListener("progress", ({loaded,total})=>{
        let fileLoaded = Math.floor((loaded / total) * 100); // geting percentage of loaded file size
        let fileTotal = Math.floor(total / 1000); // getting file size in KB from bytes
        let fileSize;
        // if file size is less than 1024 then add only KB else convert size into KB to MB
        (fileTotal < 1024 ) ? fileSize = fileTotal + "KB" : fileSize = (loaded/(1024 * 1024)).toFixed(2) + "MB";
        let progressHTML = `<li class="row">
                              <i class="fas fa-file-alt"></i>
                             <div class="image_content">
                                <div class="details">
                                    <span class="name">${name} . Uploading</span>
                                    <span class="percent">${fileLoaded}%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress" style = "width: ${fileLoaded}%"></div>
                                </div>
                             </div>

                            </li>`;        
        uploadedArea.innerHTML = "";
        progressArea.innerHTML = progressHTML;
        if(loaded == total){
            progressArea.innerHTML = "";
            let uploadedHTML = `<li class="row">
                            <div class="image_content">
                                <i class="fas fa-file-alt"></i>
                                <div class="details">
                                    <span class="name">${name} . Uploaded</span>
                                    <span class="size">${fileSize}</span>
                                </div>
                            </div>
                            <i class="fas fa-check"></i>
                            </li>`;

            uploadedArea.innerHTML = uploadedHTML;
            //uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
        }
    });
    let formData = new FormData(form); // formData is an object to easily send form data
    xhr.send(formData); // sending form data to php
}