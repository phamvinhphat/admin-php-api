export const protectedRoutes = [
    '/',
    '/account-settings',
    '/authorization',
    '/post',
    '/post/*',
    '/profile/*',
];

export function isMatch(str: string, rule: string) {
    const escapeRegex = (val: string) =>
        val.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, '\\$1');
    return new RegExp(`^${rule.split('*').map(escapeRegex).join('.*')}$`).test(
        str
    );
}
export const loginRoute = '/pages/login';
