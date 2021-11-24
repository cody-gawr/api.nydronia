import { NydroniaFinance } from './nydroniafinance';
import type Token from './token';

export default interface Chain {
    readonly platforms: Record<string, Record<string, unknown>> & {
        nydroniafinance: NydroniaFinance;
    };
    readonly tokens: Record<string, Token>;
    readonly tokenAddressMap: Record<string, Token>;
}
