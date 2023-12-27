let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    function dateShow(){
      var checkBox = document.getElementById("myCheck");
      var datePicker = document.getElementById("show");
      let input = document.querySelector("#show");
      if (checkBox.checked == true){
        datePicker.style.display = "block";
        input.disabled = false;
      } else {
         datePicker.style.display = "none";
         input.disabled = true;
      }
   }
   