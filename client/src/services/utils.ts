import { tokenKey } from '@configs/constants';

import { IToken } from './types';
import Geocode from 'react-geocode';

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

function snakeToCamel(str: string) {
    const splitString = str.split('_');
    let result = '';
    splitString.forEach((sstr, iter) => {
        if (iter !== 0) {
            result += sstr.charAt(0).toUpperCase() + sstr.slice(1);
        } else result += sstr;
    });
    return result;
}

export function convertToCamelCase(target: any) {
    const keys = Object.keys(target);
    keys.forEach((key) => {
        if (typeof target[key] === 'object') convertToCamelCase(target[key]);

        const converted = snakeToCamel(key);
        if (key !== converted) {
            // eslint-disable-next-line no-param-reassign
            target[converted] = target[key];
            // eslint-disable-next-line no-param-reassign
            delete target[key];
        }
    });
}

const apiKey = process.env.NEXT_PUBLIC_API_MAP_KEY;
export const getAddress = async (latitude: string, longitude: string) => {
    const values = await Geocode.fromLatLng(latitude, longitude, apiKey);
    return values.results[0].formatted_address;
};
