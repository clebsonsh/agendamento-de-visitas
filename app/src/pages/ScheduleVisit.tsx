import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router";
import { Box } from "@mui/material";

import VehicleCard from "../components/VehicleCard";
import type { Schedule, Vehicle } from "../types/interfaces";
import ScheduleCard from "../components/Schedule/ScheduleCard";
import { fetchVehicleById, fetchScheduleById } from "../services/apiService";
import ScheduleVisitForm from "../components/Schedule/ScheduleVisitForm";

function ScheduleVisit() {
  const params = useParams();
  const vehicleId = params.vehicleId!;
  const scheduleId = params.scheduleId!;

  const { data: vehicleData, isFetching: isFetchingVehicle } = useQuery({
    queryKey: ["vehicles", vehicleId],
    queryFn: () => fetchVehicleById(vehicleId),
  });

  const { data: scheduleData, isFetching: isFetchingSchedule } = useQuery({
    queryKey: ["schedules", scheduleId],
    queryFn: () => fetchScheduleById(scheduleId),
  });

  const vehicle: Vehicle = vehicleData?.vehicle;
  const schedule: Schedule = scheduleData?.schedule;

  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "space-between",
        gap: 4,
      }}
    >
      <Box sx={{ width: "32%" }}>
        {!isFetchingVehicle && <VehicleCard key={vehicle.id} {...vehicle} />}
      </Box>
      <Box sx={{ flexGrow: 1 }}>
        {!isFetchingSchedule && (
          <ScheduleCard header="Concluir Agendamento">
            <ScheduleVisitForm {...schedule} />
          </ScheduleCard>
        )}
      </Box>
    </Box>
  );
}

export default ScheduleVisit;
