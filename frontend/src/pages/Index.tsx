import { Box, CircularProgress, Typography } from "@mui/material";
import { useQuery } from "@tanstack/react-query";
import { Link } from "react-router";

import VehicleCard from "../components/VehicleCard";

import type { Vehicle } from "../types/interfaces";
import { fetchVehicles } from "../services/apiService";

function Index() {
  const { data, isFetching, isError, error } = useQuery({
    queryKey: ["vehicles"],
    queryFn: fetchVehicles,
  });

  if (isFetching) {
    return (
      <Box sx={{ display: "flex", justifyContent: "center", mt: 8 }}>
        <CircularProgress />
      </Box>
    );
  }

  if (isError) {
    return (
      <Box sx={{ textAlign: "center", mt: 8 }}>
        <Typography color="error" variant="h6">
          {error instanceof Error ? error.message : "Erro ao carregar veículos."}
        </Typography>
      </Box>
    );
  }

  const vehicles = data?.vehicles;

  if (!vehicles || vehicles.length === 0) {
    return (
      <Box sx={{ textAlign: "center", mt: 8 }}>
        <Typography variant="h6">Nenhum veículo disponível no momento.</Typography>
      </Box>
    );
  }

  return (
    <Box sx={{ display: "flex", justifyContent: "space-between", gap: 4 }}>
      {vehicles.map((vehicle: Vehicle) => (
        <Link
          key={vehicle.id}
          to={`/${vehicle.id}`}
          style={{ textDecoration: "none" }}
        >
          <VehicleCard
            id={vehicle.id}
            image={vehicle.image}
            make={vehicle.make}
            model={vehicle.model}
            version={vehicle.version}
            price={vehicle.price}
            salePoint={vehicle.salePoint}
          />
        </Link>
      ))}
    </Box>
  );
}

export default Index;
