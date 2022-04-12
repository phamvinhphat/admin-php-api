import { useQuery } from 'react-query';

import { client } from '@services';
import { IResponse, IRole } from '@services/types';

const useGetRoles = () => {
    return useQuery<IResponse<IRole[]>, IResponse<undefined>>(
        'getRoles',
        async () => {
            const response = await client.instance.get('/role/getAllRole');
            if (response.status === 200) {
                return response.data;
            }
            return response;
        }
    );
};

export default useGetRoles;
