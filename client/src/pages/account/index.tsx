import React from 'react';

import { Grid, Typography } from '@mui/material';

const Account = () => {
    return (
        <Grid container>
            <Grid item xs={12}>
                <Typography variant="h5">
                    System&apos;s accounts management
                </Typography>
                <Typography variant="body2">
                    Manage system&apos;s user accounts and administrator
                    accounts
                </Typography>
            </Grid>
        </Grid>
    );
};

export default Account;
