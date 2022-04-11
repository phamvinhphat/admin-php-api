import React from 'react';

import { Grid, Typography } from '@mui/material';

const Posts = () => {
    return (
        <Grid container>
            <Grid item xs={12}>
                <Typography variant="h5">Posts</Typography>
                <Typography variant="body2">
                    Manage user&apos;s posts
                </Typography>
            </Grid>
        </Grid>
    );
};

export default Posts;
