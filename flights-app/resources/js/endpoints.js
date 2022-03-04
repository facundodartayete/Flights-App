const flightEndpoints = {
    get: (id = 0) => `/flights${id ? `/${id}` : ""}`,
    create: () => "/flights",
    update: (id) => `/flights/${id}`,
    delete: (id) => `/flights/${id}`,
};
const cityEndpoints = {};
const airlineEndpoints = {
    get: (id = 0) => `/airlines${id ? `/${id}` : ""}`,
    create: () => "/airlines",
    update: (id) => `/airlines/${id}`,
    delete: (id) => `/airlines/${id}`,
    cities: (id) => `/airlines/${id}/cities`,
};
export { flightEndpoints, cityEndpoints, airlineEndpoints };
