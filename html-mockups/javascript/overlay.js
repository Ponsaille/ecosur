class Overlay {
    constructor(overlay, button) {
        this.overlay = overlay;
        this.button = button;
        this.closeButtons = this.overlay.getElementsByClassName('overlay_close');
        this.button.addEventListener('click', this.open);
        for(let i = 0; i < this.closeButtons.length; i++) {
            this.closeButtons[i].addEventListener('click', this.close);
        }
    }

    toggle = () => {
        this.overlay.classList.toggle('open');
    }

    open = () => {
        if(!this.overlay.classList.contains('open')) {
            this.overlay.classList.add('open')
        }
    }

    close = () => {
        if(this.overlay.classList.contains('open')) {
            this.overlay.classList.remove('open')
        }
    }
}