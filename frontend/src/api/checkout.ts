import useSWR from "swr";
import useSWRMutation from "swr/mutation";
import { fetcher } from "../lib/fetcher/clientFetcher";
import { FlowExecutionResponse, IPaymentRequiredDataResponse, IPaymentStatusResponse } from "./types";

export const RUN_PAYMENT_PATH = () => `/rest/payments`;

export function useRunPayment() {
  const { trigger, data, isMutating, error } = useSWRMutation(
    RUN_PAYMENT_PATH(),
    (url, { arg }) => fetcher<any>(url, { body: arg, method: "POST" }),
    { throwOnError: true }
  );

  return {
    doRunPayment: trigger,
    isLoading: isMutating,
    data,
    error,
  };
}

