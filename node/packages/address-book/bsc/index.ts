import { pancake } from './platforms/pancake';
import { tokens } from './tokens/tokens';
import { convertSymbolTokenMapToAddressTokenMap } from '../../../src/utils/convertSymbolTokenMapToAddressTokenMap';
import Chain from '../../../src/types/chain';
import { ConstInterface } from '../../../src/types/const';

const _bsc = {
    platforms: {
        pancake,
    },
    tokens,
    tokenAddressMap: convertSymbolTokenMapToAddressTokenMap(tokens),
}

export const bsc: ConstInterface<typeof _bsc, Chain> = _bsc;
