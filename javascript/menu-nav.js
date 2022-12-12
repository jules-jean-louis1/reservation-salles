function updatemenu() {
    if (document.getElementById('responsive-menu').checked == true) {
      document.getElementById('menu-header').style.borderBottomRightRadius = '0';
      document.getElementById('menu-header').style.borderBottomLeftRadius = '0';
    }else{
      document.getElementById('menu-header').style.borderRadius = '0px';
    }
  }
  