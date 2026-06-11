import APIResponseError from "../errors/APIResponseError";
import type { CreateVisitRequest, ErrorResponse } from "../types/interfaces";

const API_BASE_URL = import.meta.env.VITE_BACKEND_URL;

if (!API_BASE_URL) {
  throw new Error(
    "VITE_BACKEND_URL environment variable is not defined. " +
      "Please create a .env file with VITE_BACKEND_URL=http://localhost:8000/",
  );
}

async function request<T>(url: string, options?: RequestInit): Promise<T> {
  let response: Response;

  try {
    response = await fetch(url, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      ...options,
    });
  } catch {
    throw new APIResponseError({
      message:
        "Não foi possível conectar ao servidor. Verifique sua conexão de internet e tente novamente.",
      status: 0,
      errors: null,
    });
  }

  if (!response.ok) {
    const contentType = response.headers.get("content-type");

    if (contentType?.includes("application/json")) {
      const json = await response.json();

      const errorData: ErrorResponse = {
        status: response.status,
        message: json.message ?? "Erro inesperado.",
        errors: json.errors ?? null,
      };

      throw new APIResponseError(errorData);
    }

    throw new APIResponseError({
      status: response.status,
      message: `Erro inesperado do servidor (${response.status}).`,
      errors: null,
    });
  }

  if (response.status === 204) {
    return undefined as T;
  }

  const contentType = response.headers.get("content-type");

  if (contentType?.includes("application/json")) {
    return response.json() as Promise<T>;
  }

  return undefined as T;
}

const fetchVehicles = () =>
  request<{ vehicles: import("../types/interfaces").Vehicle[] }>(
    `${API_BASE_URL}api/v1/vehicles`,
  );

const fetchVehicleById = (id: string) =>
  request<{
    vehicle: import("../types/interfaces").Vehicle;
    schedules: import("../types/interfaces").Schedules;
  }>(`${API_BASE_URL}api/v1/vehicles/${id}`);

const fetchScheduleById = (id: string) =>
  request<{ schedule: import("../types/interfaces").Schedule }>(
    `${API_BASE_URL}api/v1/schedules/${id}`,
  );

const createNewVisit = async (visitRequest: CreateVisitRequest) => {
  await request(`${API_BASE_URL}api/v1/schedules/${visitRequest.id}/visits`, {
    method: "POST",
    body: JSON.stringify(visitRequest),
  });
};

export { fetchVehicles, fetchVehicleById, fetchScheduleById, createNewVisit };
