import { Box, Button, Card, Typography } from "@mui/material";
import type { Schedules } from "../types/entities";
import ScheduleDayButton from "./ScheduleDayButton";
import ScheduleHourButton from "./ScheduleHourButton";
import { useState } from "react";

function ScheduleCard(schedules: Schedules) {
  const firstDayInSchedules: string = Object.keys(schedules)[0];

  const [selectedDay, setSelectedDay] = useState("");
  const [selectedScheduleId, setSelectedScheduleId] = useState(0);

  const handleSelectDayClick = (day: string) => {
    setSelectedDay(day);
    setSelectedScheduleId(0);
  };
  const handleSelectScheduleClick = (id: number) => setSelectedScheduleId(id);

  const activeSchedules = schedules[selectedDay || firstDayInSchedules];

  const month: string = new Date(firstDayInSchedules)
    .toLocaleDateString("pt-BR", {
      month: "long",
    })
    .toUpperCase();

  const year: string = firstDayInSchedules.slice(0, 4);

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
            {Object.keys(schedules).map((day) => (
              <ScheduleDayButton
                key={day}
                day={day}
                active={selectedDay == day}
                handleClick={handleSelectDayClick}
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
                schedule={schedule}
                disabled={!selectedDay}
                active={selectedScheduleId === schedule.id}
                handleClick={handleSelectScheduleClick}
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
            <Button
              disabled={!selectedScheduleId}
              variant="contained"
              size="large"
            >
              Agendar Visita
            </Button>
          </Box>
        </Box>
      </Box>
    </Card>
  );
}

export default ScheduleCard;
