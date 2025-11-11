import type { Schedules } from "../../types/entities";
import { Box, Button, Typography } from "@mui/material";
import ScheduleDayButton from "./ScheduleDayButton";
import ScheduleHourButton from "./ScheduleHourButton";
import { useState } from "react";

function ScheduleSelect(schedules: Schedules) {
  const firstDayInSchedules: string = Object.keys(schedules)[0];

  const month: string = new Date(firstDayInSchedules)
    .toLocaleDateString("pt-BR", {
      month: "long",
    })
    .toUpperCase();

  const year: string = firstDayInSchedules.slice(0, 4);

  const [selectedDay, setSelectedDay] = useState("");
  const [selectedScheduleId, setSelectedScheduleId] = useState(0);

  const handleSelectDayClick = (day: string) => {
    setSelectedDay(day);
    setSelectedScheduleId(0);
  };
  const handleSelectScheduleClick = (id: number) => setSelectedScheduleId(id);

  const activeSchedules = schedules[selectedDay || firstDayInSchedules];

  return (
    <>
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
            selected={selectedDay == day}
            handleClick={handleSelectDayClick}
          />
        ))}
      </Box>
      <Box
        sx={{
          display: "grid",
          gridTemplateColumns: "repeat(5, 1fr)",
          gridTemplateRows: "min-content 42px",
          padding: "12px 24px",
          minHeight: "120px",
          gap: "16px 24px",
        }}
      >
        {activeSchedules.map((schedule) => (
          <ScheduleHourButton
            key={schedule.id}
            schedule={schedule}
            disabled={!selectedDay}
            selected={selectedScheduleId === schedule.id}
            handleClick={handleSelectScheduleClick}
          />
        ))}
      </Box>
      <Box>
        <Button disabled={!selectedScheduleId} variant="contained" size="large">
          Agendar Visita
        </Button>
      </Box>
    </>
  );
}

export default ScheduleSelect;
