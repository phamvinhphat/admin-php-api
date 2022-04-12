import { ReactNode, useRef, useState } from 'react';

import Box, { BoxProps } from '@mui/material/Box';
import List from '@mui/material/List';
import { styled, useTheme } from '@mui/material/styles';
import PerfectScrollbar from 'react-perfect-scrollbar';

import VerticalNavHeader from '@core/layouts/components/vertical/navigation/VerticalNavHeader';
import VerticalNavItems from '@core/layouts/components/vertical/navigation/VerticalNavItems';
import { VerticalNavItemsType, Settings } from '@core/layouts/types';
import { hexToRGBA } from '@core/utils/hex-to-rgba';

import Drawer from './Drawer';

// ** Util Import

interface Props {
    hidden: boolean;
    navWidth: number;
    settings: Settings;
    children: ReactNode;
    navVisible: boolean;
    toggleNavVisibility: () => void;
    setNavVisible: (value: boolean) => void;
    verticalNavItems?: VerticalNavItemsType;
    saveSettings: (values: Settings) => void;
    verticalNavMenuContent?: (props?: any) => ReactNode;
    afterVerticalNavMenuContent?: (props?: any) => ReactNode;
    beforeVerticalNavMenuContent?: (props?: any) => ReactNode;
}

const StyledBoxForShadow = styled(Box)<BoxProps>({
    top: 50,
    left: -8,
    zIndex: 2,
    height: 75,
    display: 'none',
    position: 'absolute',
    pointerEvents: 'none',
    width: 'calc(100% + 15px)',
    '&.d-block': {
        display: 'block',
    },
});

const Navigation = (props: Props) => {
    // ** Props
    const {
        hidden,
        afterVerticalNavMenuContent,
        beforeVerticalNavMenuContent,
        verticalNavMenuContent: userVerticalNavMenuContent,
    } = props;

    // ** States
    const [groupActive, setGroupActive] = useState<string[]>([]);
    const [currentActiveGroup, setCurrentActiveGroup] = useState<string[]>([]);

    // ** Ref
    const shadowRef = useRef(null);

    // ** Hooks
    const theme = useTheme();

    // ** Fixes Navigation InfiniteScroll
    const handleInfiniteScroll = (ref: HTMLElement) => {
        if (ref) {
            // @ts-ignore
            // eslint-disable-next-line no-param-reassign,no-underscore-dangle
            ref._getBoundingClientRect = ref.getBoundingClientRect;

            // eslint-disable-next-line no-param-reassign
            ref.getBoundingClientRect = () => {
                // @ts-ignore
                // eslint-disable-next-line no-underscore-dangle
                const original = ref._getBoundingClientRect();

                return { ...original, height: Math.floor(original.height) };
            };
        }
    };

    // ** Scroll Menu
    const scrollMenu = (container: any) => {
        // eslint-disable-next-line no-param-reassign
        container = hidden ? container.target : container;
        if (shadowRef && container.scrollTop > 0) {
            // @ts-ignore
            if (!shadowRef.current.classList.contains('d-block')) {
                // @ts-ignore
                shadowRef.current.classList.add('d-block');
            }
        } else {
            // @ts-ignore
            shadowRef.current.classList.remove('d-block');
        }
    };

    const ScrollWrapper = (hidden ? Box : PerfectScrollbar) as any;

    return (
        <Drawer {...props}>
            <VerticalNavHeader {...props} />
            <StyledBoxForShadow
                ref={shadowRef}
                sx={{
                    background: `linear-gradient(${
                        theme.palette.background.default
                    } 40%,${hexToRGBA(
                        theme.palette.background.default,
                        0.1
                    )} 95%,${hexToRGBA(
                        theme.palette.background.default,
                        0.05
                    )})`,
                }}
            />
            <Box
                sx={{
                    height: '100%',
                    position: 'relative',
                    overflow: 'hidden',
                }}
            >
                <ScrollWrapper
                    containerRef={(ref: any) => handleInfiniteScroll(ref)}
                    {...(hidden
                        ? {
                              onScroll: (container: any) =>
                                  scrollMenu(container),
                              sx: {
                                  height: '100%',
                                  overflowY: 'auto',
                                  overflowX: 'hidden',
                              },
                          }
                        : {
                              options: { wheelPropagation: false },
                              onScrollY: (container: any) =>
                                  scrollMenu(container),
                          })}
                >
                    {beforeVerticalNavMenuContent
                        ? beforeVerticalNavMenuContent(props)
                        : null}
                    <Box
                        sx={{
                            height: '100%',
                            display: 'flex',
                            flexDirection: 'column',
                            justifyContent: 'space-between',
                        }}
                    >
                        {userVerticalNavMenuContent ? (
                            userVerticalNavMenuContent(props)
                        ) : (
                            <List
                                className="nav-items"
                                sx={{
                                    transition: 'padding .25s ease',
                                    pr: 4.5,
                                }}
                            >
                                <VerticalNavItems
                                    groupActive={groupActive}
                                    setGroupActive={setGroupActive}
                                    currentActiveGroup={currentActiveGroup}
                                    setCurrentActiveGroup={
                                        setCurrentActiveGroup
                                    }
                                    {...props}
                                />
                            </List>
                        )}
                    </Box>
                </ScrollWrapper>
            </Box>
            {afterVerticalNavMenuContent
                ? afterVerticalNavMenuContent(props)
                : null}
        </Drawer>
    );
};

export default Navigation;
