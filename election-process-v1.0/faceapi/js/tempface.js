
const video = document.getElementById("inputVideo");
const URL_PAGE_USER = "http://localhost/temp/tempfaceapi/resulttemp.php" ; ;
const REFERANS_IMAGE = " " ;
const MODEL_URI = "http://localhost/Mekadv1.0/faceapi/model/"
Promise.all([
  //  add model 
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
      
      
      const img = await faceapi.fetchImage(`http://localhost/Mekadv1.0/faceapi/images/${element}.jpg`)
      
      const detections1 = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
      
      descriptions.push(detections1.descriptor)
    
          return new faceapi.LabeledFaceDescriptors(label, descriptions)
      })
      )
}
//  a event listener : run method when play a camera web 
video.addEventListener("play", async () => {
  const canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);
  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);
  const labeledFaceDescriptors = await loadLabeledImages()
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.4)
  
  var time = setInterval(async () => {
    const detections = await faceapi.detectAllFaces(video,new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors()
    const resizedDetections = faceapi.resizeResults(detections, displaySize);
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
    faceapi.draw.drawDetections(canvas, resizedDetections);
    faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
    results.forEach((result, i) => {
      console.log(result.toString())
      const box = resizedDetections[i].detection.box
      const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
      drawBox.draw(canvas)
      text = results.toString()
      value = text.search("unknown");
          if(value == -1){
            alert(text.toString());
             location.href = URL_PAGE_USER ;
            return ;
            }
    })
    
  }, 100);
  time2 = setInterval(async ()=>{
    console.log("time1=" + time);
    clearInterval(time);
    console.log("time2=" + time);
    clearInterval(time2);
    
    
  },20000);
});
