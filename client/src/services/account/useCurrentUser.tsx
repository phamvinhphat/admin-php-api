import { useQuery } from 'react-query';

import { client } from '@services';
import { IResponse, IUser } from '@services/types';

const useCurrentUser = () => {
    return useQuery<IResponse<IUser>, IResponse<undefined>>(
        'getInfo',
        async () => {
            const { data } = await client.instance.get<IResponse<IUser>>(
                '/account/getMyInfo'
            );
            return data;
        }
    );
};

export default useCurrentUser;
