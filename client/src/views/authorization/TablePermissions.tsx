import { useEffect, useState } from 'react';

import {
    Box,
    Card,
    CardHeader,
    IconButton,
    Paper,
    Table,
    TableBody,
    TableContainer,
    TableHead,
    TableRow,
    Typography,
} from '@mui/material';
import TableCell from '@mui/material/TableCell';
import { MinusCircleOutline, PlusCircleOutline } from 'mdi-material-ui';
import { toast } from 'react-toastify';

import {
    useGetGrantedPermissionOfRole,
    useGrantRolePermission,
    useRemoveRolePermission,
} from '@services/permission';
import { IPermission, IRolePermissions } from '@services/types';

interface Column {
    id: 'name' | 'actions';
    label: string;
    minWidth?: number;
    fullWidth?: boolean;
}

const columns: Column[] = [
    { id: 'name', label: 'Name', fullWidth: true },
    { id: 'actions', label: '', minWidth: 100 },
];
interface Props {
    available?: IPermission[];
    roleId?: string;
    onGranted?: (data: IRolePermissions) => void;
    onRemoved?: (data: IRolePermissions) => void;
}
const TablePermissions = ({
    available,
    roleId,
    onGranted,
    onRemoved,
}: Props) => {
    const [added, setAdded] = useState<IRolePermissions[]>([]);
    const { mutate, data: response } = useGetGrantedPermissionOfRole();
    const { mutateAsync: grant } = useGrantRolePermission();
    const { mutateAsync: remove } = useRemoveRolePermission();

    useEffect(() => {
        if (roleId) {
            mutate({ roleId });
        }
    }, [mutate, roleId]);

    useEffect(() => {
        if (response) {
            const { result } = response;
            if (result.length > 0) {
                setAdded(result);
            }
        }
    }, [response]);

    const handleAddPermission = (permissionId: string) => {
        if (roleId) {
            toast.promise(
                grant(
                    { roleId, permissionId },
                    {
                        onSuccess: (data) => {
                            if (data.result) {
                                toast.success('Permission granted');
                                setAdded((prevState) => [
                                    ...prevState,
                                    { roleId, permissionId },
                                ]);
                                if (onGranted)
                                    onGranted({ roleId, permissionId });
                            }
                        },
                    }
                ),
                {
                    pending: 'Authorizing...',
                }
            );
        }
    };

    const handleRemovePermission = (permissionId: string) => {
        if (roleId) {
            toast.promise(
                remove(
                    { roleId, permissionId },
                    {
                        onSuccess: (data) => {
                            if (data.result) {
                                toast.success('Permission removed');
                                setAdded((prevState) =>
                                    prevState.filter(
                                        (item) =>
                                            item.permissionId ===
                                                permissionId &&
                                            item.roleId === roleId
                                    )
                                );
                                if (onRemoved)
                                    onRemoved({ roleId, permissionId });
                            }
                        },
                    }
                ),
                {
                    pending: 'Authorizing...',
                }
            );
        }
    };

    return (
        <Card>
            <CardHeader
                title="Permissions"
                titleTypographyProps={{ variant: 'h6' }}
            />
            <Paper
                sx={{
                    display: 'flex',
                    flexDirection: 'row',
                    gap: 5,
                    overflow: 'hidden',
                }}
            >
                <Box
                    sx={{
                        width: () => (added.length > 0 ? '50%' : '100%'),
                    }}
                >
                    <Typography
                        variant="subtitle2"
                        sx={{
                            width: '100%',
                            paddingLeft: 10,
                            paddingBottom: 5,
                            display: () => (!roleId ? 'none' : 'block'),
                        }}
                    >
                        Available
                    </Typography>
                    <TableContainer sx={{ maxHeight: 440 }}>
                        <Table stickyHeader>
                            <TableHead>
                                <TableRow>
                                    {columns.map((column) => (
                                        <TableCell
                                            key={column.id}
                                            sx={{
                                                minWidth: column.minWidth,
                                                width: () =>
                                                    column.fullWidth
                                                        ? '100%'
                                                        : undefined,
                                            }}
                                        >
                                            {column.label}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                {available ? (
                                    available
                                        .filter(
                                            (item) =>
                                                !added
                                                    ?.flatMap(
                                                        (inner) =>
                                                            inner.permissionId
                                                    )
                                                    .includes(item.id)
                                        )
                                        .map((item) => (
                                            <TableRow key={item.id}>
                                                <TableCell
                                                    key={`${item.id}_name`}
                                                >
                                                    {item.name}
                                                </TableCell>
                                                <TableCell
                                                    key={`${item.id}_action`}
                                                >
                                                    <IconButton
                                                        color="error"
                                                        disabled={!roleId}
                                                        onClick={() =>
                                                            handleAddPermission(
                                                                item.id
                                                            )
                                                        }
                                                    >
                                                        <PlusCircleOutline />
                                                    </IconButton>
                                                </TableCell>
                                            </TableRow>
                                        ))
                                ) : (
                                    <TableRow>
                                        <TableCell>No permission</TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </TableContainer>
                </Box>
                <Box
                    sx={{
                        width: '50%',
                        ...(added && added.length <= 0
                            ? { display: 'none' }
                            : {}),
                    }}
                >
                    <Typography
                        variant="subtitle2"
                        sx={{
                            width: '100%',
                            paddingLeft: 10,
                            paddingBottom: 5,
                        }}
                    >
                        Added
                    </Typography>
                    <TableContainer sx={{ maxHeight: 440 }}>
                        <Table stickyHeader>
                            <TableHead>
                                <TableRow>
                                    {columns.map((column) => (
                                        <TableCell
                                            key={column.id}
                                            sx={{
                                                minWidth: column.minWidth,
                                                width: () =>
                                                    column.fullWidth
                                                        ? '100%'
                                                        : undefined,
                                            }}
                                        >
                                            {column.label}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                {available ? (
                                    available
                                        .filter((item) =>
                                            added
                                                ?.flatMap(
                                                    (inner) =>
                                                        inner.permissionId
                                                )
                                                .includes(item.id)
                                        )
                                        .map((item) => (
                                            <TableRow key={item.id}>
                                                <TableCell
                                                    key={`${item.id}_name`}
                                                >
                                                    {item.name}
                                                </TableCell>
                                                <TableCell
                                                    key={`${item.id}_action`}
                                                >
                                                    <IconButton
                                                        color="primary"
                                                        onClick={() =>
                                                            handleRemovePermission(
                                                                item.id
                                                            )
                                                        }
                                                    >
                                                        <MinusCircleOutline />
                                                    </IconButton>
                                                </TableCell>
                                            </TableRow>
                                        ))
                                ) : (
                                    <TableRow>
                                        <TableCell>No permission</TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </TableContainer>
                </Box>
            </Paper>
        </Card>
    );
};

export default TablePermissions;
