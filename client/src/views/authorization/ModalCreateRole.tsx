import React from 'react';

import {
    Modal,
    Card,
    CardHeader,
    Button,
    CardContent,
    TextField,
} from '@mui/material';

interface Props {
    open?: boolean;
    onBackdropClick?: () => void;
}

const ModalCreateRole: React.FC<Props> = ({ open, onBackdropClick }) => {
    const [name, setName] = React.useState<string>();
    const rootRef = React.useRef<HTMLDivElement>(null);

    const handleCreateRole = () => {};

    return (
        <Modal
            disablePortal
            disableEnforceFocus
            disableAutoFocus
            open={open ?? false}
            onBackdropClick={onBackdropClick}
            aria-labelledby="server-modal-title"
            aria-describedby="server-modal-description"
            sx={{
                display: 'flex',
                p: 1,
                alignItems: 'center',
                justifyContent: 'center',
            }}
            container={() => rootRef.current}
        >
            <Card sx={{ width: 400 }}>
                <CardHeader
                    title="Create new role"
                    action={
                        <Button variant="contained" onClick={handleCreateRole}>
                            Create
                        </Button>
                    }
                />
                <CardContent>
                    <TextField
                        required
                        fullWidth
                        value={name}
                        label="Role name"
                        placeholder="Moderator"
                        onChange={(event) => setName(event.target.value)}
                    />
                </CardContent>
            </Card>
        </Modal>
    );
};

export default ModalCreateRole;
