
function comperface(id){
    
    const video = document.getElementById("inputVideo");
    const REFERANS_IMAGE = id.toString() ;
    const MODEL_URI2 = "http://localhost/Mekadv2.0/faceapi/Model/"
    const MODEL_URI = "Model/"
    
        Promise.all([
            faceapi.loadMtcnnModel(MODEL_URI),
            faceapi.loadFaceRecognitionModel(MODEL_URI),
            faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URI),
            faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URI),
            faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URI),
            
            faceapi.loadSsdMobilenetv1Model(MODEL_URI),
            faceapi.loadFaceLandmarkModel(MODEL_URI),
            faceapi.loadFaceRecognitionModel(MODEL_URI),
            ]).then(startVideo);
   
    

    function startVideo() {
    console.log("add model")
    //  method to run camera web 
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
    video.srcObject = stream;
    })
    .catch(function (err0r) {
    console.log("Something went wrong!");
    });
    }

    function loadLabeledImages(){
    //  method to get referans images
    const labels = [REFERANS_IMAGE]
        return Promise.all(
        labels.map(async label => {
        const descriptions = []
        
        
        const img = await faceapi.fetchImage(`images/${label}.jpg`);
        
        const detections1 = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
        console.log(detections1)
        descriptions.push(detections1.descriptor);
        
            return new faceapi.LabeledFaceDescriptors(label, descriptions);
        })
        )
    }
    //  a event listener : run method when play a camera web 
    video.addEventListener("play", async () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);
    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas, displaySize);
    const labeledFaceDescriptors = await loadLabeledImages();
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.4);
    
    var time = setInterval(async () => {
        const detections = await faceapi.detectAllFaces(video,new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
        const resizedDetections = faceapi.resizeResults(detections, displaySize);
        canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
        faceapi.draw.drawDetections(canvas, resizedDetections);
        faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
        const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
        results.forEach((result, i) => {
        
        const box = resizedDetections[i].detection.box;
        const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
        drawBox.draw(canvas);
        text = results.toString();
        console.log(text)
        value = text.search("unknown");
            if(value == -1){
                location.href = "Http://localhost/Mekadv2.0/loginaccount.php?id="+id;
            //    login(id);
               clearInterval(time);
               clearInterval(time2);
                return ;
                }
        })
        
    }, 300);

    var time2 = setInterval( ()=>{
        
        clearInterval(time);
        location.href = "http://localhost/Mekadv2.0/sign-in.php";
        clearInterval(time2);
        
        
        
    },20000);
    });
} 
   
// function login(id){
    
//     var myRequest ;
//     if(window.XMLHttpRequest){
//         myRequest = new XMLHttpRequest();

//     }else{
//         myRequest = new ActiveXObject("Microsoft.XMLHTTP");

//     }
//     myRequest.onreadystatechange = function (){
//          var idelement  = document;
//         if(this.readyState == 4 && this.status == 200){
//             idelement.innerHTML = this.responseText ;
//         }else if (this.readyState > 0 && this.readyState < 4){
//                 //  idelement.innerHTML = "plase waiting " ; 
//         }else{
//                 // idelement.innerHTML = "ERORR IN YOUR REQUEST" ;
//         }
//     } ;
    
//     myRequest.open("POST","Http://localhost/Mekadv1.0/loginaccount.php", true);
//     myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     myRequest.send("id="+ id  );
// }


