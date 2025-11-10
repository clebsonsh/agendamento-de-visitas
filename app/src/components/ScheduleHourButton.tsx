import { Box } from "@mui/material";

interface ScheduleHourButtonProps {
  hour: string;
  active: boolean;
}
function ScheduleHourButton({ hour, active }: ScheduleHourButtonProps) {
  return (
    <Box
      sx={{
        backgroundColor: active ? "#4c9300" : "#f0f0f0",
        color: active ? "#f0f6fc" : "inherit",
        padding: "12px 30px",
        borderRadius: "30px",
        boxShadow: "var(--Paper-shadow)",
      }}
    >
      {hour}
    </Box>
  );
}

export default ScheduleHourButton;
