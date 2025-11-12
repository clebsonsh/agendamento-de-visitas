import type { ErrorDetails, ErrorResponse } from "../types/interfaces";

class APIResponseError extends Error {
  public errors: ErrorDetails | null;
  public status: number;

  constructor(data: ErrorResponse) {
    super(data.message);

    this.errors = data.errors;
    this.status = data.status;
  }
}

export default APIResponseError;
