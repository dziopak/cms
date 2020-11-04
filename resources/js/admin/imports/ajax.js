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
export const postCallBlob = async (endpoint, data, callback) => {
    try {
        const response = await axios.post(endpoint, {
            data
        },
        { 'Content-Type': `multipart/form-data`, });

        callback(response);
        return response;
    } catch (error) {
        console.error(error);
    }
};
