import APIResponseError from "../errors/APIResponseError";
import type { CreateVisitRequest, ErrorResponse } from "../types/interfaces";

const API_BASE_URL = import.meta.env.VITE_BACKEND_URL;

const fetchVehicles = () =>
  fetch(`${API_BASE_URL}api/v1/vehicles`).then((res) => res.json());

const fetchVehicleById = (id: string) =>
  fetch(`${API_BASE_URL}api/v1/vehicles/${id}`).then((res) => res.json());

const fetchScheduleById = (id: string) =>
  fetch(`${API_BASE_URL}api/v1/schedules/${id}`).then((res) => res.json());

const createNewVisit = async (visitRequest: CreateVisitRequest) => {
  const response = await fetch(
    `${API_BASE_URL}api/v1/schedules/${visitRequest.id}/visits`,
    {
      method: "POST",
      body: JSON.stringify(visitRequest),
    },
  );

  if (!response.ok) {
    const json = await response.json();

    const errorData: ErrorResponse = {
      status: response.status,
      ...json,
    };

    throw new APIResponseError(errorData);
  }
};

export { fetchVehicles, fetchVehicleById, fetchScheduleById, createNewVisit };
