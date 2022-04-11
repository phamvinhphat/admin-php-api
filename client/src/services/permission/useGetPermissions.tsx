import { useQuery } from 'react-query';

import { client } from '@services';
import { IPermission, IResponse } from '@services/types';

const useGetPermissions = () => {
    return useQuery<IResponse<IPermission>, IResponse<undefined>>(
        'getPermissions',
        async () => {
            const response = await client.instance.get(
                '/permission/getViewPermission'
            );
            if (response.status === 200) {
                return response.data;
            }
            return response;
        }
    );
};

export default useGetPermissions;
