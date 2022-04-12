import {
    FormControl,
    FormHelperText,
    InputLabel,
    MenuItem,
    Select,
    SelectProps,
} from '@mui/material';
import { Control, useController } from 'react-hook-form';

export interface SelectOption {
    label?: string;
    value: number | string;
}

export interface SelectFieldProps
    extends Omit<SelectProps, 'value' | 'onChange' | 'onBlur' | 'label'> {
    name: string;
    control: Control<any>;
    label?: string;
    disabled?: boolean;
    options: SelectOption[];
}

export function SelectField({
    name,
    control,
    label,
    disabled,
    options,
    size,
    ...rest
}: SelectFieldProps) {
    const {
        field: { value, onChange, onBlur },
        fieldState: { invalid, error },
    } = useController({
        name,
        control,
    });

    return (
        <FormControl
            fullWidth
            variant="outlined"
            margin="normal"
            size={size}
            disabled={disabled}
            error={invalid}
            sx={{ margin: 0 }}
        >
            <InputLabel id={`${name}_label`}>{label}</InputLabel>
            <Select
                labelId={`${name}_label`}
                value={value}
                onChange={onChange}
                onBlur={onBlur}
                label={label}
                {...rest}
            >
                {options.map((option) => (
                    <MenuItem key={option.value} value={option.value}>
                        {option.label}
                    </MenuItem>
                ))}
            </Select>
            <FormHelperText>{error?.message}</FormHelperText>
        </FormControl>
    );
}
