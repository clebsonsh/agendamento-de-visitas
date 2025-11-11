import { Box, Card, Typography } from "@mui/material";

interface ScheduleCardProps {
  children: React.ReactNode;
  header: string;
}

function ScheduleCard({ children, header }: ScheduleCardProps) {
  return (
    <Card
      sx={{
        borderRadius: 4,
        minHeight: 540,
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
          {header}
        </Typography>
        <Box
          sx={{
            display: "flex",
            flexDirection: "column",
            padding: "32px 0",
            gap: 4,
          }}
        >
          {children}
        </Box>
      </Box>
    </Card>
  );
}

export default ScheduleCard;
