const constraints = {
    audio: false,
    video: {
        width: 640,
        height: 480
    }
};

navigator.getUserMedia = (navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia
);

var video_status = true;
var image_status = false;

var current;
var PosX = 100;
var PosY = 100;
var width = 150;
let maxZIndex = 0;

const canvas_settings = {
    width: 640,
    height: 480
};

const getCanvasVideo = () => document.getElementById("canvasVideo");
const getCanvasPhoto = () => document.getElementById("canvasPhoto");

function successCallback(stream) {
    var video = document.querySelector('video');
    video.srcObject = stream;
    video.onloadedmetadata = function (e) {
        video.play();
    };
};

function errorCallback(err) {
    video_status = false;
    console.log("The following error occured: " + err);
};

if (navigator.getUserMedia)
    navigator.getUserMedia(constraints, successCallback, errorCallback);
else
    console.error("getUserMedia not supported");

function takeSnap() {
    if (video_status == true || image_status == true) {
        const video = document.querySelector('video');
        
        const canvas = document.createElement('canvas')
        canvas.width = canvas_settings.width;
        canvas.height = canvas_settings.height;

        const context = canvas.getContext('2d');  

        const canvasPhoto = getCanvasPhoto();
        canvasPhoto.insertBefore(canvas, canvasPhoto.firstChild);
        canvasPhoto.appendChild(canvas);

        if (document.getElementById('image').src) {
            const image = new Image();
            image.src = document.getElementById('image').src;
            context.drawImage(image, 0, 0, 640, 480);
        } else
            context.drawImage(video, 0, 0, 640, 480);

        const canvasVideo = getCanvasVideo();            
        for (let i = 0; i < canvasVideo.children.length; i++) {
            const curentCanvas = canvasVideo.children[i];
            curentCanvas.getContext('2d');
            context.drawImage(curentCanvas, 0, 0);
        }            

        const data = canvas.toDataURL('image/png');
        canvas.setAttribute('src', data);
        document.getElementById('img').value = data;

        const fd = new FormData(document.forms["form"]);
        const httpr = new XMLHttpRequest();
        httpr.open('POST', 'server/upload_img.php', true);
        httpr.send(fd);
    } else
        alert("Choose your picture.");
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        image = document.getElementById('image');
        reader.onload = function(e) {
            image.style.display = "";
            image.setAttribute('src', e.target.result);
            image.height = 480;
            image.width = 640;
            document.getElementById('video').style.display = "none";
        };

        reader.readAsDataURL(input.files[0]);
    }
    image_status = true;
}


function show_img(img_url) {
    if ((video_status == true || image_status == true) && img_url) {
        current = img_url;

        const imgId = "filtercanvas_" + img_url;

        var element = document.getElementById(imgId);
        if (element)
            element.parentNode.removeChild(element);

        let canvas = document.createElement('canvas');
        canvas.width = canvas_settings.width;
        canvas.height = canvas_settings.height;
        canvas.draggable = true;
        canvas.id = imgId;
        canvas.addEventListener("click", getClickPosition, false);
        canvas.style.zIndex = maxZIndex;
        canvas.style.position = 'absolute';

        getCanvasVideo().appendChild(canvas);

        var img = new Image();
        img.src = document.getElementById(img_url).value;

        var context = canvas.getContext('2d');
        context.drawImage(img, PosX, PosY, width, width);

        maxZIndex++;
    }
}

function getClickPosition(e) {
    if (current) {
        var rect = getCanvasVideo().getBoundingClientRect();
        PosX = e.clientX - rect.left - (width / 2);
        PosY = e.clientY - rect.top - (width / 2);
        show_img(current);
    }
}

function plus() {
    if (current) {
        width += 20;
        show_img(current);
    }
}

function minus() {
    if (current) {
        width -= 20;
        if (width < 20)
            width = 20;
        show_img(current);
    }
}
