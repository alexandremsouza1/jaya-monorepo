import { cookies } from 'next/headers'
import { baseFetcher } from './fetcherUtils'

export async function serverFetcher<T>(path: string, options?: RequestInit): Promise<T> {
  const accessToken = cookies().get('Authorization')?.value as string
  const refreshToken = cookies().get('Refresh-Token')?.value as string
  const env = cookies().get('Environment')?.value as string
  const opts = {
    ...options,
    cache: 'no-store' as RequestCache,
  }

  return baseFetcher<T>(path, accessToken, refreshToken, env, opts)
}
