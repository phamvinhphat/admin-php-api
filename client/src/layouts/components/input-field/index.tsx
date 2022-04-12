import React from 'react';

import { TextField, TextFieldProps } from '@mui/material';
import { Control, useController } from 'react-hook-form';

export type InputFieldProps = Omit<
    TextFieldProps,
    | 'value'
    | 'onChange'
    | 'onBLue'
    | 'ref'
    | 'helperText'
    | 'error'
    | 'label'
    | 'inputRef'
> & {
    name: string;
    control: Control<any>;
    label?: string;
};

const InputField = ({
    name,
    control,
    label,
    ...inputProps
}: InputFieldProps) => {
    const {
        field: { value, onChange, onBlur, ref },
        fieldState: { invalid, error },
    } = useController({
        name,
        control,
    });

    return (
        <TextField
            value={value}
            onChange={onChange}
            onBlur={onBlur}
            label={label}
            inputRef={ref}
            error={invalid}
            helperText={error?.message}
            {...inputProps}
        />
    );
};

export default InputField;
