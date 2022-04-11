import {
    Button,
    Card,
    CardHeader,
    Paper,
    Table,
    TableBody,
    TableContainer,
    TableHead,
    TableRow,
} from '@mui/material';
import TableCell from '@mui/material/TableCell';

import { IPermission } from '@services/types';

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
    data?: IPermission[];
    roleId?: string;
}
const TablePermissions = ({ data }: Props) => {

    return (
        <Card>
            <CardHeader
                title="Permissions"
                titleTypographyProps={{ variant: 'h6' }}
            />
            <Paper sx={{ display: 'flex', flexDirection: 'row' }}>
                <TableContainer>
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
                        <TableBody></TableBody>
                    </Table>
                </TableContainer>
                <TableContainer>
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
                        <TableBody></TableBody>
                    </Table>
                </TableContainer>
            </Paper>
        </Card>
    );
};

export default TablePermissions;
