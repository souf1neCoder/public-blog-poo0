const searchForm = document.querySelector('#searchForm');
const searchInput = searchForm.search;
const listResults = document.querySelector('#listResults');

searchForm.onsubmit = (e) => {
  e.preventDefault();
};

searchInput.addEventListener('keyup', (e) => {
  let xhr = new XMLHttpRequest();
    xhr.open("post", "AjaxConnection/searchAjax.php",true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if(data ==="" && searchInput.value !== ""){
            listResults.innerHTML = "<li class='dropdown-item'>No results found</li>";
          }else{

            listResults.innerHTML = data;
          }
          console.log(data);
        }
      }
    };
    let formData = new FormData(searchForm);
     xhr.send(formData);
})

