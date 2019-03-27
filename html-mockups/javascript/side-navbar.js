class SideNavbar {
  constructor(navBar) {
    this.navBar = navBar;
    this.buttons = this.navBar.getElementsByClassName('side_nav_close');
    for(let i = 0; i < this.buttons.length; i++) {
      this.buttons[i].addEventListener('click', this.toggle);
    }
  }

  toggle = () => {
    this.navBar.classList.toggle('open');
  }
}