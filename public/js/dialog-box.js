$(document).ready(function () {

    class DialogBox {
        constructor() {
            this.isDialogCreated = false;
        }
        init(target) {
            this.cacheDom(target);
            this.bindEvents();
        }

        cacheDom(target) {
            this.target = target;
            this.div;
            this.closeBtn;
            this.createDialogBoxBtn = document.querySelector('.create-dialog-box-btn');
            this.inputDialogBox = document.querySelector('.input-dialog-box');
            this.name = document.querySelector('.developer-name');

        }

        disableBtn() {
            this.createDialogBoxBtn.setAttribute('disabled', 'disabled');
        }

        bindEvents() {
            this.createDialogBoxBtn.addEventListener('click', function () {
                this.createElements();
                this.disableBtn();
            }.bind(this));
        }

        createElements() {
            if (this.getIsDialogCreated() === false) {
                this.createInput(this.target);
                this.createCloseBtn(this.target);
                this.isDialogCreated = true;
            }
        }

        getIsDialogCreated() {
            return this.isDialogCreated
        }

        reset(element) {
            $('.create-dialog-box-btn')[0].removeAttribute('disabled', 'disabled');
            $(element).empty();
            this.isDialogCreated = false;
        }

        createInput(target) {
            this.div = document.createElement('div');
            this.div.className = 'form-group mx-sm-3 mb-2';
            target.appendChild(this.div);
            this.input = document.createElement('input');
            this.input.className = 'change-name form-control';
            this.input.value = this.name.innerHTML;

            this.div.appendChild(this.input);

            this.input.addEventListener('keyup', function () {
                if (this.input.value.length < 1) {
                    this.name.innerHTML = 'Leonardo';
                } else {
                    this.name.innerHTML = this.input.value;
                }

            }.bind(this));
        }

        createCloseBtn() {
            this.closeBtn = document.createElement('span');
            this.closeBtn.className = 'close-input-box pl-3 fas fa-window-close';
            this.div.appendChild(this.closeBtn);

            this.closeBtn.addEventListener('click', function () {
                this.reset(this.inputDialogBox);
            }.bind(this));

        }
    }


    var dialogbox = new DialogBox;
    dialogbox.init($('.input-dialog-box')[0]);
})
