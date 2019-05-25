function SideNavbar(navBar) {
  this.navBar = navBar;
  this.buttons = this.navBar.getElementsByClassName('side_nav_close');

  this.toggle = () => {
    this.navBar.classList.toggle('open');
  }

  for(let i = 0; i < this.buttons.length; i++) {
    this.buttons[i].addEventListener('click', this.toggle);
  }
}