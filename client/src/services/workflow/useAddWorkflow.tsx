import { useMutation } from 'react-query';

import { client } from '@services';
import { IResponse } from '@services/types';

interface Props {
    statusId: string;
    documentId: string;
}

const useAddWorkflow = () => {
    return useMutation<IResponse<boolean>, IResponse<undefined>, Props>(
        async (variables) => {
            const response = await client.instance.post(
                '/workflow/createWorkflow',
                variables
            );
            if (response.status === 201) {
                return response.data;
            }
            return response;
        }
    );
};

export default useAddWorkflow;
