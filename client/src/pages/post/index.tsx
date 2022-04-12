import React from 'react';

import { Card, CardHeader, Grid, Typography } from '@mui/material';

import { TablePost } from '@views';

const Posts = () => {
    return (
        <Grid container>
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
                    <TablePost />
                </Card>
            </Grid>
        </Grid>
    );
};

export default Posts;
