var keyword = document.getElementById('keyword');
// var buttonSearch = document.getElementById('search');
var content = document.getElementById('content');

// 

keyword.addEventListener("keyup", function(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            content.innerHTML = this.responseText;
        }
    }
    xhr.open("GET", "ajax/students.php?cari=" + keyword.value, true);
    xhr.send();
})