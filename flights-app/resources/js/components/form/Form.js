export default class Form {
    constructor(data) {
        this.originalData = data;
        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    data() {
        let data = Object.assign({}, this);
        delete data.originalData;
        delete data.errors;

        return data;
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = "";
        }
    }

    async submit(method, url) {
        const response = await fetch(url, {
            method,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(this.data()),
        });

        if (response.ok) {
            this.reset();
            return response.json();
        } else {
            return response.json().then((error) => {
                this.errors.record(error);
                throw new Error(error.message);
            });
        }
    }
}
class Errors {
    constructor() {
        this.errors = {};
    }

    any() {
        return this.errors.length > 0;
    }

    record(errors) {
        this.errors = errors;
    }

    clear() {
        this.errors = {};
    }

    first(){
        return this.errors[0] ?? '';
    }
}
