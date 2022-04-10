import axios from 'axios';

export const tokenKey = process.env.NEXT_PUBLIC_TOKEN_KEY ?? 'token_key';
export const host = process.env.NEXT_PUBLIC_API_URL ?? 'localhost';

function getLocalToken() {
    return typeof window !== 'undefined'
        ? { Authorization: `Bearer ${window.localStorage.getItem(tokenKey)}` }
        : undefined;
}

const instance = axios.create({
    baseURL: host,
    httpAgent: '4rent-client',
    headers: {
        'Content-type': 'application/json',
        'Access-Control-Allow-Origin': '*',
        ...getLocalToken(),
    },
});

const client = {
    instance,
    tokenKey,
    host,
};

export default client;
