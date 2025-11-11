import { Box, Card, Divider, Typography } from "@mui/material";
import LocationOnOutlinedIcon from "@mui/icons-material/LocationOnOutlined";

import type { Vehicle } from "./../types/entities";

function VehicleCard(vehicle: Vehicle) {
  const brlFormatter = (amount: number) =>
    new Intl.NumberFormat("pt-BR", {
      style: "currency",
      currency: "BRL",
    }).format(amount);

  return (
    <Card
      sx={{
        borderRadius: 4,
        minHeight: 540,
        display: "flex",
        flexDirection: "column",
      }}
    >
      <img
        style={{
          height: "auto",
          maxWidth: "100%",
        }}
        src={vehicle.image}
      />
      <Box
        sx={{
          flexGrow: 1,
          padding: 2,
          display: "flex",
          flexDirection: "column",
          justifyContent: "space-between",
        }}
      >
        <Box>
          <Typography variant="h5" component="div" sx={{ fontWeight: 600 }}>
            {vehicle.make} {vehicle.model}
          </Typography>
          <Typography variant="subtitle1" component="div">
            {vehicle.version}
          </Typography>
        </Box>

        <Box>
          <Typography variant="h5" component="div" sx={{ padding: "12px 0" }}>
            {brlFormatter(vehicle.price)}
          </Typography>
          <Divider />
          <Box
            sx={{
              display: "flex",
              alignItems: "center",
              gap: 1,
              padding: "12px 0 0",
            }}
          >
            <LocationOnOutlinedIcon />
            <Typography variant="subtitle1" component="div">
              {vehicle.salePoint}
            </Typography>
          </Box>
        </Box>
      </Box>
    </Card>
  );
}

export default VehicleCard;
