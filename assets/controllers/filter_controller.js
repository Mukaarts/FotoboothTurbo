import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['form'];

    search() {
        clearTimeout(this._timeout);
        this._timeout = setTimeout(() => {
            this.formTarget.requestSubmit();
        }, 300);
    }

    submit() {
        this.formTarget.requestSubmit();
    }
}
