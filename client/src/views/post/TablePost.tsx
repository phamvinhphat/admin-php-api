import { TableContainer, Table, TableHead, TableBody, TableRow, TableCell } from '@mui/material';

interface Column {
    id: '';
    label: string;
    fullWidth?: boolean;
    minWidth?: number | string;
}

const columns: Column[] = [
    {}
]

const TablePost = () => {
    return (
        <TableContainer>
            <Table>
                <TableHead>
                    <TableRow>
                        {columns.map(item => (

                        ))}
                    </TableRow>
                </TableHead>
                <TableBody>

                </TableBody>
            </Table>
        </TableContainer>
    );
};

export default TablePost;
