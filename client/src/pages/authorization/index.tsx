import { useState } from 'react';

import { Button, Grid, Typography } from '@mui/material';
import { AccountKeyOutline } from 'mdi-material-ui';

import { useGetPermissions } from '@services/permission';
import { useGetRoles } from '@services/role';
import { ModalCreateRole, TablePermissions, TableRoles } from '@views';

const Authorization = () => {
    const [roleId, setRoleId] = useState<string>();
    const [showCreateRole, setShowCreateRole] = useState<boolean>(false);

    const { data: roles } = useGetRoles();
    const { data: permissions } = useGetPermissions();
    return (
        <>
            <Grid container spacing={5}>
                <ModalCreateRole
                    open={showCreateRole}
                    onBackdropClick={() => setShowCreateRole(false)}
                />
                <Grid item xs={12}>
                    <Typography variant="h5">Permission and roles</Typography>
                    <Typography variant="body2">
                        Application roles anh permissions
                    </Typography>
                </Grid>
                <Grid
                    item
                    xs={12}
                    sx={{ display: 'flex', justifyContent: 'start' }}
                >
                    <Button
                        variant="outlined"
                        onClick={() => setShowCreateRole(!showCreateRole)}
                    >
                        <AccountKeyOutline />
                        <Typography sx={{ paddingLeft: 5 }} color="primary">
                            Add Role
                        </Typography>
                    </Button>
                </Grid>
                <Grid item xs={12} lg={4}>
                    {/*    Roles table */}
                    <TableRoles data={roles?.result} onRowLoad={setRoleId} />
                </Grid>
                <Grid item xs={12} lg={8}>
                    <TablePermissions
                        available={permissions?.result}
                        roleId={roleId}
                    />
                </Grid>
            </Grid>
        </>
    );
};

export default Authorization;
