import { Box } from "@mui/material";
import { useQuery } from "@tanstack/react-query";
import { Link } from "react-router";

import VehicleCard from "../components/VehicleCard";

import type { Vehicle } from "../types/interfaces";
import { fetchVehicles } from "../services/apiService";

function Index() {
  const query = useQuery({
    queryKey: ["vehicles"],
    queryFn: fetchVehicles,
  });

  return (
    <Box sx={{ display: "flex", justifyContent: "space-between", gap: 4 }}>
      {query.data?.vehicles?.map((vehicle: Vehicle) => (
        <Link
          key={vehicle.id}
          to={`/${vehicle.id}`}
          style={{ textDecoration: "none" }}
        >
          <VehicleCard key={vehicle.id} {...vehicle} />
        </Link>
      ))}
    </Box>
  );
}

export default Index;
