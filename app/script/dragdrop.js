var dropzone = document.getElementById("dropzone");

// 드래그 앤 드롭 이벤트 리스너 등록
dropzone.addEventListener("dragenter", function (event) {
    event.preventDefault();
    dropzone.classList.add("dragover");
});

dropzone.addEventListener("dragover", function (event) {
    event.preventDefault();
    dropzone.classList.add("dragover");
});

dropzone.addEventListener("dragleave", function (event) {
    event.preventDefault();
    dropzone.classList.remove("dragover");
});

dropzone.addEventListener("drop", function (event) {
    event.preventDefault();
    dropzone.classList.remove("dragover");

    var files = event.dataTransfer.files;
    var fileinput = document.getElementById("fileinput");
    fileinput.files = files;
});
