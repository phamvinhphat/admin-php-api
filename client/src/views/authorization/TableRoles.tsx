import { ChangeEvent, useState } from 'react';

import {
    Card,
    CardHeader,
    IconButton,
    Paper,
    Table,
    TableBody,
    TableContainer,
    TableHead,
    TableRow,
} from '@mui/material';
import TableCell from '@mui/material/TableCell';
import TablePagination from '@mui/material/TablePagination';
import {
    ArrowExpandRight,
    PencilOutline,
    TrashCanOutline,
} from 'mdi-material-ui';

import { IRole } from '@services/types';

interface Column {
    id: 'name' | 'actions';
    label: string;
    minWidth?: number;
    fullWidth?: boolean;
}

const columns: Column[] = [
    { id: 'name', label: 'Name', fullWidth: true },
    { id: 'actions', label: '', minWidth: 190 },
];

interface Props {
    data?: IRole[];
    onRowLoad?: (id: string) => void;
    onRowDelete?: (id: string) => void;
    onRowEdit?: (id: string) => void;
}

const TableRoles = ({ data, onRowDelete, onRowLoad, onRowEdit }: Props) => {
    const [page, setPage] = useState<number>(0);
    const [rowsPerPage, setRowsPerPage] = useState<number>(10);

    const handleChangePage = (event: unknown, newPage: number) => {
        setPage(newPage);
    };

    const handleChangeRowsPerPage = (event: ChangeEvent<HTMLInputElement>) => {
        setRowsPerPage(+event.target.value);
        setPage(0);
    };

    const handleRowDelete = (id: string) => {
        if (onRowDelete) onRowDelete(id);
    };
    const handleRowLoad = (id: string) => {
        if (onRowLoad) onRowLoad(id);
    };
    const handleRowEdit = (id: string) => {
        if (onRowEdit) onRowEdit(id);
    };

    return (
        <Card>
            <CardHeader
                title="Roles"
                titleTypographyProps={{ variant: 'h6' }}
            />
            <Paper>
                <TableContainer>
                    <Table stickyHeader aria-label="role-table">
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
                            {data && data.length > 0 ? (
                                data
                                    .slice(
                                        page * rowsPerPage,
                                        page * rowsPerPage + rowsPerPage
                                    )
                                    .map((row, index) => {
                                        return (
                                            <TableRow
                                                hover
                                                role="checkbox"
                                                tabIndex={-1}
                                                key={index}
                                            >
                                                <TableCell
                                                    align="left"
                                                    key={row.id}
                                                >
                                                    {row.name}
                                                </TableCell>
                                                <TableCell
                                                    align="left"
                                                    key={`${row.id}_action`}
                                                >
                                                    <IconButton
                                                        color="error"
                                                        onClick={() =>
                                                            handleRowDelete(
                                                                row.id
                                                            )
                                                        }
                                                    >
                                                        <TrashCanOutline />
                                                    </IconButton>
                                                    <IconButton
                                                        color="primary"
                                                        onClick={() =>
                                                            handleRowEdit(
                                                                row.id
                                                            )
                                                        }
                                                    >
                                                        <PencilOutline />
                                                    </IconButton>
                                                    <IconButton
                                                        onClick={() =>
                                                            handleRowLoad(
                                                                row.id
                                                            )
                                                        }
                                                    >
                                                        <ArrowExpandRight />
                                                    </IconButton>
                                                </TableCell>
                                            </TableRow>
                                        );
                                    })
                            ) : (
                                <TableRow>
                                    <TableCell align="left">No data</TableCell>
                                    <TableCell />
                                    <TableCell />
                                </TableRow>
                            )}
                        </TableBody>
                    </Table>
                    <TablePagination
                        rowsPerPageOptions={[10, 25, 100]}
                        component="div"
                        count={data?.length ?? 0}
                        rowsPerPage={rowsPerPage}
                        page={page}
                        onPageChange={handleChangePage}
                        onRowsPerPageChange={handleChangeRowsPerPage}
                    />
                </TableContainer>
            </Paper>
        </Card>
    );
};

export default TableRoles;
