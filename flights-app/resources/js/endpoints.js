const flightEndpoints = {
    get: (id = 0) => `/api/flights${id ? `/${id}` : ""}`,
    create: () => "/api/flights",
    update: (id) => `/api/flights/${id}`,
    delete: (id) => `/api/flights/${id}`,
};
const cityEndpoints = {};
const airlineEndpoints = {
    get: (id = 0) => `/api/airlines${id ? `/${id}` : ""}`,
    create: () => "/api/airlines",
    update: (id) => `/api/airlines/${id}`,
    delete: (id) => `/api/airlines/${id}`,
    cities: (id) => `/api/airlines/${id}/cities`,
};
export { flightEndpoints, cityEndpoints, airlineEndpoints };
