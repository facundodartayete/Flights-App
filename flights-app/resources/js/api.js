const request = async (method, url, body = {}) => {
    const options = {
        method: method,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            accept: "application/json",
            "Content-Type": "application/json",
        },
    };

    if (Object.keys(body).length > 0) options.body = JSON.stringify(body);

    const response = await fetch(url, options);

    if (!response.ok) {
        throw Error(response.statusText);
    }
    return response.json();
};

const getRequest = async (url) => request("GET", url);
const postRequest = async (url, body = {}) => request("POST", url, body);
const putRequest = async (url, body = {}) => request("PUT", url, body);
const deleteRequest = async (url) => request("DELETE", url);

export { postRequest, getRequest, putRequest, deleteRequest };
