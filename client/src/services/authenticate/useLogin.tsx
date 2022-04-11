import { useMutation } from 'react-query';

import { client } from '@services';
import { ILogin, IResponse, IToken } from '@services/types';

const useLogin = () => {
    return useMutation<IResponse<IToken>, IResponse<undefined>, ILogin>(
        async (variables) => {
            const response = await client.instance.post(
                '/auth/login',
                variables
            );
            if (response.status === 200) {
                return response.data;
            }
            return response;
        }
    );
};

export default useLogin;
