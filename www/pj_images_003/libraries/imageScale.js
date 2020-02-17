var canvas = document.getElementById('image-canvas');
var ctx = canvas.getContext('2d');


// Trigger the imageLoader function when a file has been selected
var fileInput = document.getElementById('img');
fileInput.addEventListener('change', imageLoader, false);

function imageLoader() {
    var reader = new FileReader();
    reader.onload = function(event) {
        img = new Image();
        img.onload = function(){
            document.body.appendChild(img);
            debugger;
            var wrh = img.width / img.height;
            var newWidth = canvas.width;
            var newHeight = newWidth / wrh;
            if (newHeight > canvas.height) {
                newHeight = canvas.height;
                newWidth = newHeight * wrh;
            }
            ctx.drawImage(img,0,0, newWidth , newHeight);
        }
        img.src = reader.result;
    }
    reader.readAsDataURL(fileInput.files[0]);
}