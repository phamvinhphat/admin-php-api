import React from 'react';
import { useRouter } from 'next/router';

const Post = () => {
    const { query } = useRouter();
    return (
        <div>
            {query}
        </div>
    );
};

export default Post;
