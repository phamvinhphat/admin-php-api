import { useCallback, useEffect, useState } from 'react';

import {
    TableContainer,
    Table,
    TableHead,
    TableBody,
    TableRow,
    TableCell,
    Typography,
    Avatar,
    Tooltip,
    Chip,
} from '@mui/material';

import { IDocument, IPostCreate, IUserView } from '@services/types';
import { convertToCamelCase, getAddress } from '@services/utils';

interface Column {
    id:
        | 'status'
        | 'contents'
        | 'price'
        | 'floor_area'
        | 'furniture_status'
        | 'views'
        | 'created_by'
        | 'address';
    label: string;
    fullWidth?: boolean;
    minWidth?: number | string;
}

interface StatusObj {
    [key: string]: {
        color: 'info' | 'success' | 'primary' | 'warning' | 'error';
    };
}
const statusObj: StatusObj = {
    Node: { color: 'info' },
    Start: { color: 'success' },
    Public: { color: 'primary' },
    Remove: { color: 'error' },
    Functional: { color: 'info' },
    Fairly: { color: 'warning' },
    Good: { color: 'success' },
};

const columns: Column[] = [
    { id: 'contents', label: 'Contents', minWidth: 250 },
    { id: 'address', label: 'Address', minWidth: 200 },
    { id: 'price', label: 'Price' },
    { id: 'furniture_status', label: 'Furniture Status' },
    { id: 'floor_area', label: 'Floor Area' },
    { id: 'views', label: 'Views' },
    { id: 'status', label: 'Status' },
    { id: 'created_by', label: 'Author' },
];

interface Props {
    data?: IDocument[];
    onRowClick?: (id: string) => void;
}

interface PostView extends IPostCreate {
    id: string;
    createdBy: IUserView;
    views: number;
    statusName: string;
}

const TablePost = ({ data, onRowClick }: Props) => {
    const [mapped, setMapped] = useState<PostView[]>([]);

    const mapping = useCallback(async () => {
        if (data && data.length > 0) {
            const values = data.map((item) => {
                const mapper: PostView = JSON.parse(item.data);
                convertToCamelCase(mapper);
                return {
                    ...mapper,
                    createdBy: item.createdBy[0],
                    statusName: item.statusName,
                    id: item.id,
                };
            });
            for (let i = 0; i < values.length; i += 1) {
                // eslint-disable-next-line no-await-in-loop
                values[i].address = await getAddress(
                    String(values[i].latitude),
                    String(values[i].longitude)
                );
            }
            setMapped(values);
        }
    }, [data]);

    useEffect(() => {
        mapping();
    }, [mapping]);

    const handleRowClick = (id: string) => {
        if (onRowClick) onRowClick(id);
    };

    return (
        <TableContainer sx={{ maxHeight: 500 }}>
            <Table stickyHeader>
                <TableHead>
                    <TableRow>
                        {columns.map((item) => (
                            <TableCell
                                sx={{
                                    minWidth: item.minWidth,
                                    width: () =>
                                        item.fullWidth ? '100%' : undefined,
                                }}
                                key={`${item.id}_head`}
                            >
                                {item.label}
                            </TableCell>
                        ))}
                    </TableRow>
                </TableHead>
                <TableBody>
                    {mapped.length > 0 ? (
                        mapped.map((item, index) => (
                            <TableRow
                                key={item.id + index}
                                onClick={() => handleRowClick(item.id)}
                            >
                                <TableCell>{item.contents}</TableCell>
                                <TableCell>{item.address}</TableCell>
                                <TableCell>{item.price}</TableCell>
                                <TableCell>
                                    <Chip
                                        color={statusObj[item.statusName].color}
                                        label={item.furnitureStatus}
                                        variant="outlined"
                                    />
                                </TableCell>
                                <TableCell>{item.floorArea}</TableCell>
                                <TableCell>{item.views}</TableCell>
                                <TableCell>
                                    <Chip
                                        color={statusObj[item.statusName].color}
                                        label={item.statusName}
                                    />
                                </TableCell>
                                <TableCell>
                                    <Tooltip
                                        title={`${item.createdBy.firstName} ${item.createdBy.lastName}`}
                                    >
                                        <Avatar
                                            src={item.createdBy?.avatar}
                                            alt={`${item.createdBy.username}_avatar`}
                                        />
                                    </Tooltip>
                                </TableCell>
                            </TableRow>
                        ))
                    ) : (
                        <TableRow>
                            <TableCell>
                                <Typography
                                    variant="subtitle1"
                                    sx={{ width: '100%', textAlign: 'center' }}
                                >
                                    No data
                                </Typography>
                            </TableCell>
                        </TableRow>
                    )}
                </TableBody>
            </Table>
        </TableContainer>
    );
};

export default TablePost;
