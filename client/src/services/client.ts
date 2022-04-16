import axios from 'axios';
import { toast } from 'react-toastify';

import { host } from '@configs/constants';

import { IResponse, IToken } from './types';
import { getLocalToken, removeLocalToken, setLocalToken } from './utils';

const instance = axios.create({
    baseURL: host,
    httpAgent: '4rent-client',
    headers: {
        'Content-type': 'application/json',
        'Access-Control-Allow-Origin': '*',
        ...getLocalToken(),
    },
});

instance.interceptors.response.use(
    (value) => {
        return value;
    },
    (value) => {
        if (
            value.response.status === 401 &&
            !value.request.responseURL.includes('/account/refresh')
        ) {
            return instance
                .get<IResponse<IToken>>('/account/refresh')
                .then((response) => {
                    if (response.data && response.status === 200) {
                        const { result } = response.data;
                        setLocalToken(result);
                        window.location.reload();
                        return instance({
                            ...value.config,
                            headers: {
                                ...value.config.headers,
                                ...getLocalToken(),
                            },
                        });
                    }
                    removeLocalToken();
                    return response;
                });
        }
        if (value.response) {
            const { message: msg } = value.response
                .data as IResponse<undefined>;
            if (msg) {
                toast.error(msg, { position: 'top-left' });
            }
        }
        return value;
    }
);

const client = { instance };

export default client;
