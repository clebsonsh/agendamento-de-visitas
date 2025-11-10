import { Box, Button, Card, Typography } from "@mui/material";
import type { Schedules } from "../types/entities";
import ScheduleDayButton from "./ScheduleDayButton";
import ScheduleHourButton from "./ScheduleHourButton";

function ScheduleCard(schedules: Schedules) {
  const days: Array<Date> = Object.keys(schedules).map((day) => new Date(day));

  const activeDay = days[2];

  const activeSchedules = schedules[activeDay.toISOString().split("T")[0]];

  const monthAndYear: Date = days[0];
  const month: string = monthAndYear
    .toLocaleDateString("pt-BR", {
      month: "long",
    })
    .toUpperCase();

  const year: number = monthAndYear.getFullYear();

  const getHourAndMinutes = (date: string) => {
    const hour = new Date(date).getHours();

    return `${hour}:00`;
  };

  return (
    <Card
      sx={{
        borderRadius: 4,
      }}
    >
      <Box
        sx={{
          textAlign: "center",
        }}
      >
        <Typography
          variant="h5"
          sx={{
            padding: "24px 0",
            backgroundColor: "#2e323c",
            color: "#f0f6fc",
          }}
        >
          Agende o dia e horario da sua visita
        </Typography>
        <Box
          sx={{
            display: "flex",
            flexDirection: "column",
            padding: "32px 0",
            gap: 4,
          }}
        >
          <Typography variant="h5">
            {month} {year}
          </Typography>
          <Box
            sx={{
              display: "flex",
              padding: "8px 0",
              width: "100%",
              justifyContent: "center",
              gap: 4,
            }}
          >
            {days.map((day) => (
              <ScheduleDayButton
                key={day.toDateString()}
                date={day}
                active={activeDay == day}
              />
            ))}
          </Box>
          <Box
            sx={{
              display: "flex",
              padding: "8px 0",
              width: "100%",
              justifyContent: "center",
              gap: 4,
            }}
          >
            {activeSchedules.map((schedule) => (
              <ScheduleHourButton
                key={schedule.id}
                active={false}
                hour={getHourAndMinutes(schedule.scheduledAt)}
              />
            ))}
          </Box>
          <Box
            sx={{
              display: "flex",
              padding: "8px 0",
              width: "100%",
              justifyContent: "center",
              gap: 4,
            }}
          >
            <Button variant="contained" size="large">
              Agendar Visita
            </Button>
          </Box>
        </Box>
      </Box>
    </Card>
  );
}

export default ScheduleCard;
