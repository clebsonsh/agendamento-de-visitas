import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router";
import { Box, CircularProgress, Typography } from "@mui/material";

import VehicleCard from "../components/VehicleCard";

import type { Schedules, Vehicle } from "../types/interfaces";
import ScheduleCard from "../components/Schedule/ScheduleCard";
import ScheduleSelect from "../components/Schedule/ScheduleSelect";
import { fetchVehicleById } from "../services/apiService";

function Schedule() {
  const vehicleId: string = useParams().vehicleId!;

  const { data, isFetching, isError, error } = useQuery({
    queryKey: ["vehicles", vehicleId],
    queryFn: () => fetchVehicleById(vehicleId),
  });

  if (isFetching) {
    return (
      <Box sx={{ display: "flex", justifyContent: "center", mt: 8 }}>
        <CircularProgress />
      </Box>
    );
  }

  if (isError) {
    return (
      <Box sx={{ textAlign: "center", mt: 8 }}>
        <Typography color="error" variant="h6">
          {error instanceof Error ? error.message : "Erro ao carregar dados."}
        </Typography>
      </Box>
    );
  }

  const vehicle: Vehicle | undefined = data?.vehicle;
  const schedules: Schedules | undefined = data?.schedules;

  if (!vehicle) {
    return (
      <Box sx={{ textAlign: "center", mt: 8 }}>
        <Typography variant="h6">Veículo não encontrado.</Typography>
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
        {schedules && Object.keys(schedules).length > 0 ? (
          <ScheduleCard header="Agende o dia e horario da sua visita">
            <ScheduleSelect schedules={schedules} />
          </ScheduleCard>
        ) : (
          <ScheduleCard header="Agende o dia e horario da sua visita">
            <Typography variant="body1" sx={{ p: 4 }}>
              Nenhum horário disponível para este veículo no momento.
            </Typography>
          </ScheduleCard>
        )}
      </Box>
    </Box>
  );
}

export default Schedule;
