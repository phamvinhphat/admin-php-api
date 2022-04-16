import { useMutation } from 'react-query';

import { client } from '@services';
import { IDocument, IResponse } from '@services/types';

const useGetPost = () => {
    return useMutation<IResponse<IDocument[]>, IResponse<undefined>, string>(
        async (variables) => {
            const response = await client.instance.get(
                `/document/findDocumentById/${variables}`
            );
            if (response.status === 200) {
                return response.data;
            }
            return response;
        }
    );
};

export default useGetPost;
