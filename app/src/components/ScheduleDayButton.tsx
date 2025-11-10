import { Box } from "@mui/material";

interface ScheduleDayButtonProps {
  date: Date;
  active: boolean;
}
function ScheduleDayButton({ date, active }: ScheduleDayButtonProps) {
  const dayName: string = date
    .toLocaleDateString("pt-BR", {
      weekday: "long",
    })
    .toUpperCase()
    .slice(0, 3);

  const dayNumber: number = date.getDate();

  return (
    <Box
      sx={{
        backgroundColor: active ? "#4c9300" : "#f0f0f0",
        color: active ? "#f0f6fc" : "inherit",
        padding: "22px 30px",
        borderRadius: "50%",
        display: "flex",
        flexDirection: "column",
        boxShadow: "var(--Paper-shadow)",
      }}
    >
      <div>{dayName}</div>
      <div>{dayNumber}</div>
    </Box>
  );
}

export default ScheduleDayButton;
