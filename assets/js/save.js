const formsSave = document.querySelectorAll(".save_form");
formsSave.forEach((form)=>{
  form.addEventListener("submit",(e)=>{
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "AjaxConnection/saveAjax.php");
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          console.log(data);
          let iconSaveBtn = form.querySelector("button i");
          let oprSave = form.querySelector("#opr_save");
          if (data === "done save") {
            iconSaveBtn.classList.remove("far");
            iconSaveBtn.classList.add("fas");
            oprSave.value = "false";
          } else if (data === "done unsave") {
            iconSaveBtn.classList.remove("fas");
            iconSaveBtn.classList.add("far");
            oprSave.value = "true";
          } else if (data === "User Id Not found") {
            location.href =
              "http://localhost/PROJECTS%20PHP/S-Blog/?page=sign-in";
          } else {
            console.log("error");
          }
        }
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  })
})

