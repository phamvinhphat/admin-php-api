import { tokenKey } from '@configs/constants';

import { IToken } from './types';

export function getLocalToken() {
    return typeof window !== 'undefined' &&
        window.localStorage.getItem(tokenKey)
        ? { Authorization: `${window.localStorage.getItem(tokenKey)}` }
        : undefined;
}

export function setLocalToken(data: IToken) {
    if (typeof window !== 'undefined') {
        window.localStorage.setItem(tokenKey, data.accessToken);
        window.localStorage.setItem('expireIn', String(data.expiresIn));
    }
}

export function removeLocalToken() {
    if (typeof window !== 'undefined') {
        window.localStorage.removeItem(tokenKey);
        window.localStorage.removeItem('expireIn');
    }
}
