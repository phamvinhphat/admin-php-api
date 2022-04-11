import { Button, Grid, Typography } from '@mui/material';
import { AccountKeyOutline } from 'mdi-material-ui';

import { useGetRoles } from '@services/role';
import { TablePermissions, TableRoles } from '@views';

const Authorization = () => {
    const { data } = useGetRoles();

    return (
        <Grid container spacing={5}>
            <Grid item xs={12}>
                <Typography variant="h5">Permission and roles</Typography>
                <Typography variant="body2">
                    Application roles anh permissions
                </Typography>
            </Grid>
            <Grid item xs={12} sx={{ display: 'flex', justifyContent: 'end' }}>
                <Button>
                    <AccountKeyOutline />
                    <Typography sx={{ paddingLeft: 5 }} color="primary">
                        Add Role
                    </Typography>
                </Button>
            </Grid>
            <Grid item xs={12} lg={4}>
                {/*    Roles table */}
                <TableRoles data={data?.result} />
            </Grid>
            <Grid item xs={12} lg={8}>
                {/*    Permission table */}
                <TablePermissions />
            </Grid>
        </Grid>
    );
};

export default Authorization;
