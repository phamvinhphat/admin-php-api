import React from 'react';

import { Card, CardHeader, Grid, Typography } from '@mui/material';
import { useRouter } from 'next/router';

import { useGetPostDocument } from '@services/document';
import { TablePost } from '@views';

const Posts = () => {
    const router = useRouter();
    const { data: postDocument } = useGetPostDocument();

    const handleRowClick = (id: string) => {
        router.push(`/post/${id}`);
    };

    return (
        <Grid container spacing={5}>
            <Grid item xs={12}>
                <Typography variant="h5">Posts</Typography>
                <Typography variant="body2">
                    Manage user&apos;s posts
                </Typography>
            </Grid>
            <Grid item xs={12}>
                <Card>
                    <CardHeader
                        title="Post"
                        titleTypographyProps={{ variant: 'h6' }}
                    />
                    <TablePost
                        data={postDocument}
                        onRowClick={handleRowClick}
                    />
                </Card>
            </Grid>
        </Grid>
    );
};

export default Posts;
