![download](https://user-images.githubusercontent.com/49564849/86054152-4d05ab80-ba62-11ea-8477-22c37730b161.gif)

![image](https://user-images.githubusercontent.com/49564849/86052618-f4351380-ba5f-11ea-990e-bfc84f839e38.png)
 
![download (1)](https://user-images.githubusercontent.com/49564849/86054218-6b6ba700-ba62-11ea-8d1a-ddf326930bc2.gif)

Introduction
Now you are ready to build your fist web applications, like pros. If you didn’t mind, the
web is a vast and rich world, allowing you to release quickly data and content to everyone
around the world.
Now you know the basics, here comes the time to leave those old fashioned to-do lists
and eBusiness websites, and fly away toward bigger projects.

```
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
```

An example is shown above, but it works.

![download (2)](https://user-images.githubusercontent.com/49564849/86054247-7d4d4a00-ba62-11ea-9db1-882978d724e7.gif)

![2020-06-29 22 43 24](https://user-images.githubusercontent.com/49564849/86052348-84268d80-ba5f-11ea-8de3-ab0972567d0d.jpg)

![download (3)](https://user-images.githubusercontent.com/49564849/86054307-96ee9180-ba62-11ea-8d7a-da38745e0cfa.gif)

![image](https://user-images.githubusercontent.com/49564849/86052836-470ecb00-ba60-11ea-8853-2f786d8caf7a.png)

![image](https://user-images.githubusercontent.com/49564849/86052926-6574c680-ba60-11ea-9a32-c9aa5284b202.png)

![download (4)](https://user-images.githubusercontent.com/49564849/86054340-a5d54400-ba62-11ea-9352-b3f4732951b9.gif)

* [PHP]()
* [JavaScript](https://www.javascript.com/)
* [HTML/CSS/SVG]()
* [MySQL]()

![download (5)](https://user-images.githubusercontent.com/49564849/86054395-c1d8e580-ba62-11ea-8e54-b9174570fe7a.gif)

* **Korotkov S.** - [therealadespina](https://github.com/therealadespina)
