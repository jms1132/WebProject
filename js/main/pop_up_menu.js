var flag = false;

function pop_up(id) {
  if(id===document.getElementById("btn_login")){
    if (flag === false) {
      document.getElementById("pop_up").style.display = "block";
      flag = true;
    }
  }else if(id===document.getElementById("btn_info")){
    if (flag === false) {
    document.getElementById("pop_log").style.display = "block";
      flag = true;
    }
  }
}     
  function pop_down() {
    if (flag === true) {
      document.getElementById("pop_up").style.display = "none";
      document.getElementById("pop_log").style.display = "none";
      flag = false;
    }
  }