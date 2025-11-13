import { useQuery } from "@tanstack/react-query";
import { Link, useParams } from "react-router";
import LocationOnOutlinedIcon from "@mui/icons-material/LocationOnOutlined";
import CalendarTodayOutlinedIcon from "@mui/icons-material/CalendarTodayOutlined";
import CheckOutlinedIcon from "@mui/icons-material/CheckOutlined";
import { Box, Button, Typography } from "@mui/material";

import type { Schedule, Vehicle } from "../types/interfaces";
import { fetchVehicleById, fetchScheduleById } from "../services/apiService";
import { getFormatterdDate } from "../helpers";

function ScheduleDone() {
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

  const date = getFormatterdDate(schedule?.scheduledAt);

  return (
    <Box
      sx={{
        display: "flex",
        width: "100%",
        minHeight: 700,
        justifyContent: "center",
        alignItems: "center",
      }}
    >
      {!isFetchingVehicle && !isFetchingSchedule && (
        <Box
          sx={{
            display: "flex",
            width: "100%",
            flexDirection: "column",
            alignItems: "center",
            backgroundColor: "#f7f7f8",
            padding: "48px",
            gap: 4,
            borderRadius: 4,
          }}
        >
          <Box
            sx={{
              backgroundColor: "#1976d2",
              padding: "20px 24px",
              borderRadius: "50%",
              boxShadow: "0px 0px 0px 10px #1976d288",
            }}
          >
            <CheckOutlinedIcon fontSize="large" style={{ color: "white" }} />
          </Box>
          <Typography variant="h4">Agendamento Concluído</Typography>
          <Box
            sx={{
              display: "flex",
              width: "100%",
              justifyContent: "center",
              alignItems: "center",
              gap: 2,
            }}
          >
            <CalendarTodayOutlinedIcon />
            <Typography variant="subtitle1">{date}</Typography>
            <span>|</span>
            <LocationOnOutlinedIcon />
            <Typography variant="subtitle1">{vehicle.salePoint}</Typography>
          </Box>
          <Button variant="contained" size="large" component={Link} to="/">
            Outros Veículos
          </Button>
        </Box>
      )}
    </Box>
  );
}

export default ScheduleDone;
