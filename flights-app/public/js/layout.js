$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const formRequest = ({
    e,
    form,
    url = form.attr("action"),
    success = false,
    error = (error) => {
        alert(error.responseJSON.message);
    },
}) => {
    e.preventDefault();
    const data = form.serializeArray().reduce((obj, item) => {
        obj[item.name] = item.value;
        return obj;
    }, {});

    $.ajax({
        url,
        data,
        type: form.attr("method"),
        success,
        error,
    });
};

const fetchFormRequest = async ({
    e,
    form,
    url = form.attr("action"),
    method = form.attr("method"),
}) => {
    e.preventDefault();
    const data = form.serializeArray().reduce((obj, item) => {
        obj[item.name] = item.value;
        return obj;
    }, {});
    const response = await fetch(url, {
        method,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
    if (response.ok) {
        return response.json();
    } else {
        return response.json().then((error) => {
            throw new Error(error.message);
        });
    }
};

const getQueryParams = () => window.location.href.split("?")[1] || "";
