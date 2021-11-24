import { ChainId } from "../packages/address-book";

const API_BASE_URL = process.env.API_BASE_URL || 'http://localhost:3001';

const BASE_HPY = 2190;
const MINUTELY_HPY = 525600;
const HOURLY_HPY = 8760;
const DAILY_HPY = 365;
const WEEKLY_HPY = 52;

const FORTUBE_REQ_TOKENS = 'https://bsc.for.tube/api/v2/bank_tokens';
const FORTUBE_REQ_MARKETS = 'https://bsc.for.tube/api/v1/bank/markets?mode=extended';
const FORTUBE_API_TOKEN = process.env.FORTUBE_API_TOKEN;

const MAINNET_BSC_RPC_ENDPOINTS = [
    'https://bsc-dataseed.binance.org',
    'https://bsc-dataseed1.defibit.io',
    'https://bsc-dataseed1.ninicoin.io',
    'https://bsc-dataseed2.defibit.io',
    'https://bsc-dataseed3.defibit.io',
    'https://bsc-dataseed4.defibit.io',
    'https://bsc-dataseed2.ninicoin.io',
    'https://bsc-dataseed3.ninicoin.io',
    'https://bsc-dataseed4.ninicoin.io',
    'https://bsc-dataseed1.binance.org',
    'https://bsc-dataseed2.binance.org',
    'https://bsc-dataseed3.binance.org',
    'https://bsc-dataseed4.binance.org',
];

const CUSTOM_BSC_RPC_ENDPOINTS = [process.env.BSC_RPC].filter(item => item);

const BSC_RPC_ENDPOINTS = CUSTOM_BSC_RPC_ENDPOINTS.length
  ? CUSTOM_BSC_RPC_ENDPOINTS
    : MAINNET_BSC_RPC_ENDPOINTS;

const BSC_RPC = process.env.BSC_RPC || BSC_RPC_ENDPOINTS[0];
const HECO_RPC = process.env.HECO_RPC || 'https://http-mainnet.hecochain.com';
const AVAX_RPC = process.env.AVAX_RPC || 'https://api.avax.network/ext/bc/C/rpc';
const POLYGON_RPC = process.env.POLYGON_RPC || 'https://rpc-mainnet.maticvigil.com/';
const FANTOM_RPC = process.env.FANTOM_RPC || 'https://rpc.ftm.tools';
const ONE_RPC = process.env.ONE_RPC || 'https://api.s0.t.hmny.io/';
const ARBITRUM_RPC = process.env.ARBITRUM_RPC || 'https://arb1.arbitrum.io/rpc';
const CELO_RPC = process.env.CELO_RPC || 'https://forno.celo.org';
const MOONRIVER_RPC = process.env.MOONRIVER_RPC || 'https://rpc.moonriver.moonbeam.network';
const CRONOS_RPC = process.env.CRONOS_RPC || 'https://evm-cronos.crypto.org';
const AURORA_RPC =
  process.env.AURORA_RPC ||
  'https://mainnet.aurora.dev/Fon6fPMs5rCdJc4mxX4kiSK1vsKdzc3D8k6UF8aruek';

const BSC_CHAIN_ID = ChainId.bsc;
const HECO_CHAIN_ID = ChainId.heco;
const POLYGON_CHAIN_ID = ChainId.polygon;
const AVAX_CHAIN_ID = ChainId.avax;
const FANTOM_CHAIN_ID = ChainId.fantom;
const ONE_CHAIN_ID = ChainId.one;
const ARBITRUM_CHAIN_ID = ChainId.arbitrum;
const CELO_CHAIN_ID = ChainId.celo;
const MOONRIVER_CHAIN_ID = ChainId.moonriver;
const CRONOS_CHAIN_ID = ChainId.cronos;
const AURORA_CHAIN_ID = ChainId.aurora;

const PCS_LPF = 0.003;

export {
    API_BASE_URL,
    BSC_RPC,
    BSC_RPC_ENDPOINTS,
    BSC_CHAIN_ID,
    HECO_RPC,
    HECO_CHAIN_ID,
    AVAX_RPC,
    AVAX_CHAIN_ID,
    FANTOM_RPC,
    FANTOM_CHAIN_ID,
    ONE_RPC,
    ONE_CHAIN_ID,
    ARBITRUM_RPC,
    ARBITRUM_CHAIN_ID,
    CELO_RPC,
    CELO_CHAIN_ID,
    POLYGON_RPC,
    POLYGON_CHAIN_ID,
    MOONRIVER_RPC,
    MOONRIVER_CHAIN_ID,
    CRONOS_RPC,
    CRONOS_CHAIN_ID,
    AURORA_RPC,
    AURORA_CHAIN_ID,
    BASE_HPY,
    FORTUBE_REQ_TOKENS,
    FORTUBE_REQ_MARKETS,
    FORTUBE_API_TOKEN,
    MINUTELY_HPY,
    HOURLY_HPY,
    DAILY_HPY,
    WEEKLY_HPY,
    PCS_LPF
}
