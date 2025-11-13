interface Vehicle {
  id: number;
  image: string;
  make: string;
  model: string;
  version: string;
  price: number;
  salePoint: string;
}

interface Schedule {
  id: number;
  vehicleId: number;
  scheduledAt: string;
  isBooked: boolean;
}

interface Schedules {
  [date: string]: Schedule[];
}

interface VisitFormData {
  name: string;
  email: string;
  phone: string;
}

interface CreateVisitRequest {
  id: number;
  name: string;
  email: string;
  phone: string;
}

type ErrorDetails = Record<string, string> | null;

interface ErrorResponse {
  message: string;
  status: number;
  errors: ErrorDetails;
}

export type {
  Vehicle,
  Schedule,
  Schedules,
  VisitFormData,
  CreateVisitRequest,
  ErrorResponse,
  ErrorDetails,
};
