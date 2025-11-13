import type { Schedule, Schedules } from "../../types/interfaces";
import { Box, Button, Typography } from "@mui/material";
import ScheduleDayButton from "./ScheduleDayButton";
import ScheduleHourButton from "./ScheduleHourButton";
import { useState } from "react";
import { Link } from "react-router";
import { capitalizeFirstLetter } from "../../helpers";

function ScheduleSelect(schedules: Schedules) {
  const firstDayInSchedules: string = Object.keys(schedules)[0];

  const monthAndYear: string = capitalizeFirstLetter(
    new Date(firstDayInSchedules).toLocaleDateString("pt-BR", {
      month: "long",
      year: "numeric",
    }),
  );

  const [selectedDay, setSelectedDay] = useState<string>();
  const [selectedSchedule, setSelectedSchedule] = useState<Schedule | null>(
    null,
  );

  const handleSelectDayClick = (day: string) => {
    setSelectedDay(day);
    setSelectedSchedule(null);
  };

  const handleSelectScheduleClick = (schedule: Schedule) =>
    setSelectedSchedule(schedule);

  const schedulesToShow = schedules[selectedDay || firstDayInSchedules];

  return (
    <>
      <Typography variant="h5">{monthAndYear}</Typography>
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
        {schedulesToShow.map((schedule) => (
          <ScheduleHourButton
            key={schedule.id}
            schedule={schedule}
            disabled={!selectedDay}
            selected={selectedSchedule?.id === schedule.id}
            handleClick={handleSelectScheduleClick}
          />
        ))}
      </Box>
      <Box>
        <Button
          disabled={!selectedSchedule}
          variant="contained"
          size="large"
          component={Link}
          to={`/${selectedSchedule?.vehicleId}/schedule/${selectedSchedule?.id}`}
        >
          Agendar Visita
        </Button>
      </Box>
    </>
  );
}

export default ScheduleSelect;
