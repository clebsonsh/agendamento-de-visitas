import { useState, type FormEvent } from "react";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { useNavigate } from "react-router";
import { Alert, Box, Button, TextField, Typography } from "@mui/material";

import type {
  ErrorDetails,
  Schedule,
  VisitFormData,
  CreateVisitRequest,
} from "../../types/interfaces";
import { createNewVisit } from "../../services/apiService";
import type APIResponseError from "../../errors/APIResponseError";
import { getFormatterdDate } from "../../helpers";

function ScheduleVisitForm(schedule: Schedule) {
  const date = getFormatterdDate(schedule.scheduledAt);

  const [visitFromErrors, setVisitFormErrors] = useState<ErrorDetails>();

  const [resourceAlreadyExistsError, setResourceAlreadyExistsError] =
    useState("");

  const queryClient = useQueryClient();

  const navigate = useNavigate();
  const mutation = useMutation({
    mutationFn: createNewVisit,
    onSuccess: () => {
      queryClient.invalidateQueries();
      navigate(`/${schedule.vehicleId}/schedule/${schedule.id}/done`);
    },
    onError: (error: APIResponseError) => {
      if (error.status == 422) {
        setVisitFormErrors(error.errors);
        return;
      }

      if (error.status == 409) {
        setResourceAlreadyExistsError(
          "Este horário não está mais disponível. Não foi possível concluir seu agendamento.",
        );
        return;
      }

      console.error(error);
    },
  });

  const [visitFormData, setVisitFormData] = useState<VisitFormData>({
    name: "",
    email: "",
    phone: "",
  });

  const handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = event.target;
    setVisitFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    setResourceAlreadyExistsError("");
    setVisitFormErrors(null);
    event.preventDefault();

    const createVisitRequest: CreateVisitRequest = {
      id: schedule.id,
      ...visitFormData,
    };

    mutation.mutate(createVisitRequest);
  };
  return (
    <Box
      sx={{
        display: "flex",
        flexDirection: "column",
        justifyContent: "space-between",
        padding: "0 48px",
        gap: 4,
      }}
    >
      <Typography variant="h5">{date}</Typography>
      <form
        onSubmit={handleSubmit}
        style={{
          display: "flex",
          flexDirection: "column",
          gap: 16,
        }}
      >
        <TextField
          value={visitFormData.name}
          onChange={handleChange}
          fullWidth
          id="name"
          name="name"
          label="Nome"
          variant="outlined"
          required
          error={!!visitFromErrors?.name}
          helperText={visitFromErrors?.name}
        />
        <TextField
          value={visitFormData.email}
          onChange={handleChange}
          fullWidth
          id="email"
          name="email"
          type="email"
          label="E-mail"
          variant="outlined"
          required
          error={!!visitFromErrors?.email}
          helperText={visitFromErrors?.email}
        />
        <TextField
          value={visitFormData.phone}
          onChange={handleChange}
          fullWidth
          id="phone"
          name="phone"
          label="Telefone"
          variant="outlined"
          required
          error={!!visitFromErrors?.phone}
          helperText={visitFromErrors?.phone}
        />
        <Button type="submit" variant="contained" size="large">
          Concluir
        </Button>
        {!!resourceAlreadyExistsError && (
          <Alert severity="warning">{resourceAlreadyExistsError}</Alert>
        )}
      </form>
    </Box>
  );
}

export default ScheduleVisitForm;
