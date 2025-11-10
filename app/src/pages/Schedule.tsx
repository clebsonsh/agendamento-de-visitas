import { Box } from "@mui/material";
import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router";

import VehicleCard from "../components/VehicleCard";

import type { Schedules, Vehicle } from "../types/entities";
import ScheduleCard from "../components/ScheduleCard";

function Schedule() {
  const vehicleId = useParams().vehicleId;

  const url = import.meta.env.VITE_BACKEND_URL + "api/v1/vehicles/" + vehicleId;

  const { data, isFetching } = useQuery({
    queryKey: ["vehicle"],
    queryFn: () => fetch(url).then((res) => res.json()),
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
        {!isFetching && <ScheduleCard {...schedules} />}
      </Box>
    </Box>
  );
}

export default Schedule;
