import { bsc } from './bsc';
import Chain from '../../src/types/chain';
import { ChainId } from '../../src/types/chainid';
import { ConstRecord } from '../../src/types/const';

export * from '../../src/types/chainid';

const _addressBook = {
    bsc
} as const;

const _addressBookByChainId = {
    [ChainId.bsc]: bsc,
} as const;

export const addressBook: ConstRecord<typeof _addressBook, Chain> = _addressBook;
export const addressBookByChainId: ConstRecord<typeof _addressBookByChainId, Chain> =
  _addressBookByChainId;
