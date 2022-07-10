const passIcon = document.querySelector(".passIcon");
const pass = document.getElementById("password");
passIcon.addEventListener("click",()=>{
    if(pass.type === "text"){
        pass.type = "password";
        passIcon.querySelector("i").classList.toggle("fa-eye-slash");
    }
    else{
        pass.type = "text";
        passIcon.querySelector("i").classList.toggle("fa-eye-slash");

    }
})