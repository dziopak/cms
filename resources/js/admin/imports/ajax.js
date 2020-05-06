export const postCall = async (endpoint, data, callback) => {
    try {
        const response = await axios.post(endpoint, {
            data
        });
        callback(response);
        return response;
    } catch (error) {
        console.error(error);
    }
};
