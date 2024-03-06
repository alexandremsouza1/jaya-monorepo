import useSWRMutation from "swr/mutation";
import { fetcher } from "../lib/fetcher/clientFetcher";


export function useFlowTasks() {
  async function getTasks(url: string) {
    await new Promise((resolve) => setTimeout(resolve, 1000));
    return fetcher<any>(url, { method: "GET" });
  }

  const { data, error, isMutating, trigger } = useSWRMutation(
    "/payment/private/tasks",
    getTasks,
    {
      throwOnError: false,
    }
  );

  return {
    getTasks: trigger,
    isLoading: isMutating,
    data,
    error,
  };
}

export function useFlowRetrieve(flowId: string) {
  async function getFlow(url: string) {
    await new Promise((resolve) => setTimeout(resolve, 1000));
    return fetcher<any>(url, { method: "GET" });
  }

  const { data, error, isMutating, trigger } = useSWRMutation(
    `/payment/private/flows/${flowId}`,
    getFlow,
    {
      throwOnError: false,
    }
  );

  return {
    getFlow: trigger,
    isLoading: isMutating,
    data,
    error,
  };
}
