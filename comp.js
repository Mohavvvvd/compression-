function comp(){
    f=document.getElementById("file").files[0];
    if(!f){
        alert("Please select a file !");
        return false;
    }
    var formData = new FormData();
    formData.append('f', f);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'compress.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('result').innerHTML = 'File compressed successfully.';
        } else {
            document.getElementById('status').innerHTML = 'Error compressing file.';
        }
    };

    xhr.send(formData);
};