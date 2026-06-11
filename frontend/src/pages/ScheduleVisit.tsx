import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router";
import { Box, CircularProgress, Typography } from "@mui/material";

import VehicleCard from "../components/VehicleCard";
import type { Schedule, Vehicle } from "../types/interfaces";
import ScheduleCard from "../components/Schedule/ScheduleCard";
import { fetchVehicleById, fetchScheduleById } from "../services/apiService";
import ScheduleVisitForm from "../components/Schedule/ScheduleVisitForm";

function ScheduleVisit() {
  const params = useParams();
  const vehicleId = params.vehicleId!;
  const scheduleId = params.scheduleId!;

  const { data: vehicleData, isFetching: isFetchingVehicle, isError: isVehicleError, error: vehicleError } =
    useQuery({
      queryKey: ["vehicles", vehicleId],
      queryFn: () => fetchVehicleById(vehicleId),
    });

  const {
    data: scheduleData,
    isFetching: isFetchingSchedule,
    isError: isScheduleError,
    error: scheduleError,
  } = useQuery({
    queryKey: ["schedules", scheduleId],
    queryFn: () => fetchScheduleById(scheduleId),
  });

  if (isFetchingVehicle || isFetchingSchedule) {
    return (
      <Box sx={{ display: "flex", justifyContent: "center", mt: 8 }}>
        <CircularProgress />
      </Box>
    );
  }

  if (isVehicleError || isScheduleError) {
    return (
      <Box sx={{ textAlign: "center", mt: 8 }}>
        <Typography color="error" variant="h6">
          {vehicleError instanceof Error
            ? vehicleError.message
            : scheduleError instanceof Error
              ? scheduleError.message
              : "Erro ao carregar dados."}
        </Typography>
      </Box>
    );
  }

  const vehicle: Vehicle | undefined = vehicleData?.vehicle;
  const schedule: Schedule | undefined = scheduleData?.schedule;

  if (!vehicle || !schedule) {
    return (
      <Box sx={{ textAlign: "center", mt: 8 }}>
        <Typography variant="h6">
          {!vehicle ? "Veículo não encontrado." : "Horário não encontrado."}
        </Typography>
      </Box>
    );
  }

  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "space-between",
        gap: 4,
      }}
    >
      <Box sx={{ width: "32%" }}>
        <VehicleCard
          id={vehicle.id}
          image={vehicle.image}
          make={vehicle.make}
          model={vehicle.model}
          version={vehicle.version}
          price={vehicle.price}
          salePoint={vehicle.salePoint}
        />
      </Box>
      <Box sx={{ flexGrow: 1 }}>
        <ScheduleCard header="Concluir Agendamento">
          <ScheduleVisitForm
            id={schedule.id}
            vehicleId={schedule.vehicleId}
            scheduledAt={schedule.scheduledAt}
            isBooked={schedule.isBooked}
          />
        </ScheduleCard>
      </Box>
    </Box>
  );
}

export default ScheduleVisit;
