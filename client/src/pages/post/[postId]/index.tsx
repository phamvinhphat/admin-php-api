import React, { useEffect } from 'react';

import { Button, Card, CardHeader, Grid, Typography } from '@mui/material';
import { useRouter } from 'next/router';

import { useGetPost } from '@services/post';
import { WorkflowTable, PostContainer } from '@views';

const Post = () => {
    const { query } = useRouter();
    const { mutate: getPost, data: post } = useGetPost();

    useEffect(() => {
        if (query.postId) {
            getPost(query.postId as string);
        }
    }, [query.postId]);

    return (
        <Grid container spacing={5}>
            <Grid item xs={12}>
                <Typography variant="h5">Post details</Typography>
                <Typography variant="body2">
                    More detail of a post and workflow
                </Typography>
            </Grid>
            <Grid item xs={12}>
                <Card>
                    <CardHeader
                        title="Post detail"
                        titleTypographyProps={{ variant: 'h6' }}
                    />
                    <PostContainer data={post?.result} />
                </Card>
            </Grid>
            <Grid item xs={12}>
                <Card>
                    <WorkflowTable />
                </Card>
            </Grid>
            <Grid item xs={12} container justifyContent="flex-end">
                <Button variant="contained" color="info">
                    Publish
                </Button>
            </Grid>
        </Grid>
    );
};

export default Post;
