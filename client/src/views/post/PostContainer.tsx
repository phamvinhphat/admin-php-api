import React from 'react';

import { Avatar, Box, Chip, Paper, Typography } from '@mui/material';
import { useTheme } from '@mui/material/styles';

import { IDocument, IPostCreate, IUserView } from '@services/types';
import { convertToCamelCase, getAddress } from '@services/utils';

interface Props {
    data?: IDocument[];
}
interface PostView extends IPostCreate {
    id: string;
    createdBy: IUserView;
    views: number;
    statusName: string;
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

const PostContainer = ({ data }: Props) => {
    const [post, setPost] = React.useState<PostView>();

    const theme = useTheme();

    React.useEffect(() => {
        async function mapData() {
            if (data) {
                const mapper: PostView = JSON.parse(data[0].data);
                convertToCamelCase(mapper);
                const address = await getAddress(
                    String(mapper.latitude),
                    String(mapper.longitude)
                );
                setPost({
                    ...mapper,
                    createdBy: data[0].createdBy[0],
                    statusName: data[0].statusName,
                    id: data[0].id,
                    address,
                });
            }
        }
        mapData();
    }, [data]);

    return (
        <Paper sx={{ display: 'flex', gap: 5, flexDirection: 'column' }}>
            {/*   User Info */}
            <Box sx={{ display: 'flex', gap: 5, margin: 5 }}>
                <Avatar
                    sx={{ width: '5rem', height: '5rem' }}
                    src={post?.createdBy.avatar}
                    alt={post?.createdBy.username}
                />
                <Box
                    sx={{
                        display: 'flex',
                        alignItems: 'center',
                        flexDirection: 'column',
                    }}
                >
                    <Typography variant="body1">
                        {post?.createdBy.firstName} {post?.createdBy.lastName}
                    </Typography>
                    <Typography variant="overline">
                        @{post?.createdBy.username}
                    </Typography>
                </Box>
                <Chip
                    color={statusObj[post?.statusName]?.color ?? 'error'}
                    label={post?.statusName}
                />
            </Box>
            {/*    Contents */}
            <Box
                sx={{
                    padding: 5,
                    backgroundColor:
                        theme.palette.mode === 'light'
                            ? theme.palette.grey['200']
                            : theme.palette.grey['700'],
                }}
            >
                <Typography>{post?.contents}</Typography>
            </Box>
            {/*    Room Info */}
        </Paper>
    );
};

export default PostContainer;
