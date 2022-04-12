import { useMutation } from 'react-query';

import { client } from '@services';

const useLogout = () => {
    return useMutation('logout', () => {
        return client.instance.post('/auth/logout');
    });
};

export default useLogout;
