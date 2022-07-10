const formComment = document.querySelector("#commentForm"),
  btnComment = formComment.querySelector("button"),
  listComments = document.querySelector("#commentsList");
// 
formComment.onsubmit = (e) => {
  e.preventDefault();
};
// 
let url_string = window.location.href;
let url = new URL(url_string);
let id_post = url.searchParams.get("id_post");
// 
btnComment.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "AjaxConnection/commentAjax.php",true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log(data);
        formComment.reset();
        if (data === "User Id Not found") {
          location.href =
            "http://localhost/PROJECTS%20PHP/S-Blog/?page=sign-in";
        } 
      }
    }
  };
  let formData = new FormData(formComment);
  xhr.send(formData);
};
// 
setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "AjaxConnection/commentsAjax.php",true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          listComments.innerHTML = data;
          console.log(data);
        }
      }
    };
   xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("id_post="+id_post);
},1000)