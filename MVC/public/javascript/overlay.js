function Overlay(overlay, button) {
    this.overlay = overlay;
    this.button = button;
    this.closeButtons = this.overlay.getElementsByClassName('overlay_close');

    this.toggle = () => {
        this.overlay.classList.toggle('open');
    }

    this.open = () => {
        if(!this.overlay.classList.contains('open')) {
            this.overlay.classList.add('open')
        }
    }

    this.close = () => {
        if(this.overlay.classList.contains('open')) {
            this.overlay.classList.remove('open')
        }
    }

    this.button.addEventListener('click', this.open);
    for(let i = 0; i < this.closeButtons.length; i++) {
        this.closeButtons[i].addEventListener('click', this.close);
    }
}

/*
function Chat(overlay, button) { REFAIRE UN OVERLAY QUI AFFICHER LE CHAT
    this.overlay = overlay;
    this.button = button;
    this.closeButtons = this.overlay.getElementsByClassName('chat_close');

    this.toggle = () => {
        this.overlay.classList.toggle('open');
    }

    this.open = () => {
        if(!this.overlay.classList.contains('open')) {
            this.overlay.classList.add('open')
        }
    }

    this.close = () => {
        if(this.overlay.classList.contains('open')) {
            this.overlay.classList.remove('open')
        }
    }

    this.button.addEventListener('click', this.open);
    for(let i = 0; i < this.closeButtons.length; i++) {
        this.closeButtons[i].addEventListener('click', this.close);
    }
}
*/
