import { useQuery } from "@tanstack/react-query";
import { Link, useParams } from "react-router";
import LocationOnOutlinedIcon from "@mui/icons-material/LocationOnOutlined";
import CalendarTodayOutlinedIcon from "@mui/icons-material/CalendarTodayOutlined";
import CheckOutlinedIcon from "@mui/icons-material/CheckOutlined";
import { Box, Button, CircularProgress, Typography } from "@mui/material";

import type { Schedule, Vehicle } from "../types/interfaces";
import { fetchVehicleById, fetchScheduleById } from "../services/apiService";
import { getFormattedDate } from "../helpers";

function ScheduleDone() {
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
      <Box
        sx={{
          display: "flex",
          width: "100%",
          minHeight: 700,
          justifyContent: "center",
          alignItems: "center",
        }}
      >
        <CircularProgress />
      </Box>
    );
  }

  if (isVehicleError || isScheduleError) {
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
      <Box
        sx={{
          display: "flex",
          width: "100%",
          minHeight: 700,
          justifyContent: "center",
          alignItems: "center",
        }}
      >
        <Typography variant="h6">Dados não encontrados.</Typography>
      </Box>
    );
  }

  const date = getFormattedDate(schedule.scheduledAt);

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
    </Box>
  );
}

export default ScheduleDone;
