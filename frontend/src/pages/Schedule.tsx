import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router";
import { Box } from "@mui/material";

import VehicleCard from "../components/VehicleCard";

import type { Schedules, Vehicle } from "../types/interfaces";
import ScheduleCard from "../components/Schedule/ScheduleCard";
import ScheduleSelect from "../components/Schedule/ScheduleSelect";
import { fetchVehicleById } from "../services/apiService";

function Schedule() {
  const vehicleId: string = useParams().vehicleId!;

  const { data, isFetching } = useQuery({
    queryKey: ["vehicles", vehicleId],
    queryFn: () => fetchVehicleById(vehicleId),
  });

  const vehicle: Vehicle = data?.vehicle;
  const schedules: Schedules = data?.schedules;

  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "space-between",
        gap: 4,
      }}
    >
      <Box sx={{ width: "32%" }}>
        {!isFetching && <VehicleCard key={vehicle.id} {...vehicle} />}
      </Box>
      <Box sx={{ flexGrow: 1 }}>
        {!isFetching && (
          <ScheduleCard header="Agende o dia e horario da sua visita">
            <ScheduleSelect {...schedules} />
          </ScheduleCard>
        )}
      </Box>
    </Box>
  );
}

export default Schedule;
